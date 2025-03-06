<?php
function render_faculty_projects() {
    $api = gem_app_api();
    $faculty_id = get_current_user_id();
    $projects = $api->request('/faculty/projects/' . $faculty_id);
    
    ?>
    <div class="wrap faculty-projects">
        <h1>My Projects</h1>
        
        <div class="add-new">
            <a href="?page=faculty-projects&action=new" class="button button-primary">Create New Project</a>
        </div>
        
        <div class="projects-grid">
            <?php foreach ($projects['data'] as $project): ?>
                <div class="project-card">
                    <h3><?php echo esc_html($project['title']); ?></h3>
                    <div class="project-meta">
                        <span>Students: <?php echo esc_html($project['student_count']); ?></span>
                        <span>Status: <?php echo esc_html($project['status']); ?></span>
                    </div>
                    <div class="project-actions">
                        <a href="?page=faculty-projects&action=edit&id=<?php echo esc_attr($project['id']); ?>">
                            Edit
                        </a>
                        <a href="?page=faculty-projects&action=view&id=<?php echo esc_attr($project['id']); ?>">
                            View Details
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}