class GEM_Document_Manager {
    public function __construct() {
        add_action('wp_ajax_upload_document', array($this, 'handle_document_upload'));
        add_action('wp_ajax_update_document', array($this, 'handle_document_update'));
        add_action('wp_ajax_share_document', array($this, 'handle_document_share'));
    }

    public function render_document_interface() {
        $documents = $this->get_faculty_documents();
        ?>
        <div class="wrap document-manager">
            <h1>Document Management</h1>

            <div class="document-container">
                <div class="document-sidebar">
                    <div class="upload-section">
                        <h3>Upload Documents</h3>
                        <form id="documentUpload" class="dropzone">
                            <div class="fallback">
                                <input type="file" name="file" multiple />
                            </div>
                        </form>
                    </div>

                    <div class="document-categories">
                        <h3>Categories</h3>
                        <ul>
                            <li data-category="research">Research Papers</li>
                            <li data-category="projects">Project Documents</li>
                            <li data-category="presentations">Presentations</li>
                            <li data-category="reports">Reports</li>
                        </ul>
                    </div>
                </div>

                <div class="document-main">
                    <div class="document-filters">
                        <div class="search-box">
                            <input type="text" placeholder="Search documents...">
                        </div>
                        <div class="view-options">
                            <button data-view="grid" class="active">Grid</button>
                            <button data-view="list">List</button>
                        </div>
                        <div class="sort-options">
                            <select>
                                <option value="date">Date</option>
                                <option value="name">Name</option>
                                <option value="size">Size</option>
                            </select>
                        </div>
                    </div>

                    <div class="document-grid">
                        <?php foreach ($documents as $doc): ?>
                            <div class="document-card" data-id="<?php echo esc_attr($doc->id); ?>">
                                <div class="document-icon">
                                    <?php echo $this->get_document_icon($doc->type); ?>
                                </div>
                                <div class="document-info">
                                    <h4><?php echo esc_html($doc->name); ?></h4>
                                    <p><?php echo esc_html($doc->size); ?></p>
                                    <span class="modified">
                                        <?php echo esc_html($doc->modified_date); ?>
                                    </span>
                                </div>
                                <div class="document-actions">
                                    <button class="preview">Preview</button>
                                    <button class="share">Share</button>
                                    <button class="download">Download</button>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Document Preview Modal -->
            <div id="documentPreviewModal" class="modal">
                <div class="modal-content">
                    <div class="preview-container"></div>
                    <div class="document-metadata"></div>
                    <div class="sharing-settings"></div>
                </div>
            </div>
        </div>
        <?php
    }

    private function get_document_icon($type) {
        $icons = array(
            'pdf' => '<i class="fas fa-file-pdf"></i>',
            'doc' => '<i class="fas fa-file-word"></i>',
            'xls' => '<i class="fas fa-file-excel"></i>',
            'ppt' => '<i class="fas fa-file-powerpoint"></i>',
            'img' => '<i class="fas fa-file-image"></i>',
            'default' => '<i class="fas fa-file"></i>'
        );
        
        return isset($icons[$type]) ? $icons[$type] : $icons['default'];
    }
}