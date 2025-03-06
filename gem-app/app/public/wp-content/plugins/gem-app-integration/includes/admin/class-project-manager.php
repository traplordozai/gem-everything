class GEM_Project_Manager {
    public function __construct() {
        add_action('init', array($this, 'register_project_post_type'));
        add_action('add_meta_boxes', array($this, 'add_project_meta_boxes'));
        add_action('save_post_faculty_project', array($this, 'save_project_meta'));
        add_action('wp_ajax_update_project_status', array($this, 'ajax_update_project_status'));
    }

    public function register_project_post_type() {
        register_post_type('faculty_project', array(
            'labels' => array(
                'name' => 'Projects',
                'singular_name' => 'Project'
            ),
            'public' => false,
            'show_ui' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'rewrite' => false,
            'supports' => array('title', 'editor', 'author')
        ));
    }

    public function render_project_interface() {
        $projects = $this->get_faculty_projects();
        
        ?>
        <div class="wrap project-management">
            <h1>Project Management</h1>
            
            <div class="project-filters">
                <select id="statusFilter">
                    <option value="">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                </select>
                
                <select id="sortBy">
                    <option value="date">Date</option>
                    <option value="priority">Priority</option>
                    <option value="status">Status</option>
                </select>
            </div>

            <div class="projects-kanban-board">
                <?php $this->render_kanban_columns($projects); ?>
            </div>

            <!-- Project Details Modal -->
            <div id="projectDetailsModal" class="modal">
                <div class="modal-content">
                    <div class="project-details"></div>
                    <div class="project-timeline"></div>
                    <div class="project-members"></div>
                    <div class="project-documents"></div>
                </div>
            </div>
        </div>
        <?php
    }

    private function render_kanban_columns($projects) {
        $statuses = array('pending', 'active', 'review', 'completed');
        
        foreach ($statuses as $status) {
            ?>
            <div class="kanban-column" data-status="<?php echo esc_attr($status); ?>">
                <h3><?php echo esc_html(ucfirst($status)); ?></h3>
                <div class="kanban-items" id="<?php echo esc_attr($status); ?>-items">
                    <?php
                    foreach ($projects as $project) {
                        if ($project->status === $status) {
                            $this->render_project_card($project);
                        }
                    }
                    ?>
                </div>
            </div>
            <?php
        }
    }
}