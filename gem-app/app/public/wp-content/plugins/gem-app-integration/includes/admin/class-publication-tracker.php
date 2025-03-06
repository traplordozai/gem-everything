class GEM_Publication_Tracker {
    public function __construct() {
        add_action('wp_ajax_add_publication', array($this, 'handle_publication_add'));
        add_action('wp_ajax_update_publication', array($this, 'handle_publication_update'));
        add_action('wp_ajax_import_citations', array($this, 'handle_citation_import'));
    }

    public function render_publication_interface() {
        $publications = $this->get_faculty_publications();
        ?>
        <div class="wrap publication-tracker">
            <h1>Research Publications</h1>

            <div class="publication-container">
                <div class="publication-header">
                    <div class="metrics-summary">
                        <div class="metric-card">
                            <h3>Total Publications</h3>
                            <div class="metric-value"><?php echo count($publications); ?></div>
                        </div>
                        <div class="metric-card">
                            <h3>Total Citations</h3>
                            <div class="metric-value"><?php echo $this->get_total_citations(); ?></div>
                        </div>
                        <div class="metric-card">
                            <h3>h-index</h3>
                            <div class="metric-value"><?php echo $this->calculate_h_index(); ?></div>
                        </div>
                    </div>

                    <div class="publication-actions">
                        <button id="addPublication">Add Publication</button>
                        <button id="importCitations">Import Citations</button>
                        <button id="exportData">Export Data</button>
                    </div>
                </div>

                <div class="publication-filters">
                    <select id="yearFilter">
                        <option value="">All Years</option>
                        <?php $this->render_year_options(); ?>
                    </select>
                    <select id="typeFilter">
                        <option value="">All Types</option>
                        <option value="journal">Journal Articles</option>
                        <option value="conference">Conference Papers</option>
                        <option value="book">Books/Chapters</option>
                    </select>
                    <input type="text" placeholder="Search publications...">
                </div>

                <div class="publications-list">
                    <?php foreach ($publications as $pub): ?>
                        <div class="publication-item" data-id="<?php echo esc_attr($pub->id); ?>">
                            <div class="publication-main">
                                <h3><?php echo esc_html($pub->title); ?></h3>
                                <p class="authors"><?php echo esc_html($pub->authors); ?></p>
                                <p class="venue"><?php echo esc_html($pub->venue); ?></p>
                                <p class="details">
                                    <span class="year"><?php echo esc_html($pub->year); ?></span>
                                    <span class="type"><?php echo esc_html($pub->type); ?></span>
                                    <span class="citations">
                                        Citations: <?php echo esc_html($pub->citations); ?>
                                    </span>
                                </p>
                            </div>
                            <div class="publication-actions">
                                <button class="edit">Edit</button>
                                <button class="view-metrics">Metrics</button>
                                <button class="share">Share</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Publication Form Modal -->
            <div id="publicationModal" class="modal">
                <div class="modal-content">
                    <form id="publicationForm">
                        <!-- Publication form fields -->
                    </form>
                </div>
            </div>
        </div>
        <?php
    }

    private function calculate_h_index() {
        $citations = $this->get_publication_citations();
        rsort($citations);
        
        $h = 0;
        foreach ($citations as $i => $citations_count) {
            if ($citations_count >= ($i + 1)) {
                $h = $i + 1;
            } else {
                break;
            }
        }
        
        return $h;
    }
}