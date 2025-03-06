<div class="wrap gem-faculty-portal">
    <h1>GEM Faculty Portal</h1>
    
    <div class="portal-dashboard">
        <div class="welcome-panel">
            <h2>Welcome to the Faculty Portal</h2>
            <p>Manage your academic activities, documents, and research publications from one central location.</p>
            
            <div class="quick-actions">
                <a href="<?php echo admin_url('admin.php?page=gem-calendar'); ?>" class="button button-primary">
                    <span class="dashicons dashicons-calendar-alt"></span>
                    Calendar
                </a>
                <a href="<?php echo admin_url('admin.php?page=gem-documents'); ?>" class="button button-primary">
                    <span class="dashicons dashicons-media-document"></span>
                    Documents
                </a>
                <a href="<?php echo admin_url('admin.php?page=gem-publications'); ?>" class="button button-primary">
                    <span class="dashicons dashicons-book-alt"></span>
                    Publications
                </a>
            </div>
        </div>
        
        <div class="portal-widgets">
            <div class="widget upcoming-events">
                <h3>Upcoming Events</h3>
                <?php
                $calendar = new GEM_Faculty_Calendar();
                $events = $calendar->get_upcoming_events(5);
                if ($events): ?>
                    <ul>
                        <?php foreach ($events as $event): ?>
                            <li>
                                <span class="event-date"><?php echo esc_html(date('M j', strtotime($event->start_time))); ?></span>
                                <span class="event-title"><?php echo esc_html($event->title); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No upcoming events</p>
                <?php endif; ?>
            </div>
            
            <div class="widget recent-documents">
                <h3>Recent Documents</h3>
                <?php
                $doc_manager = new GEM_Document_Manager();
                $documents = $doc_manager->get_recent_documents(5);
                if ($documents): ?>
                    <ul>
                        <?php foreach ($documents as $doc): ?>
                            <li>
                                <span class="doc-icon"><?php echo $doc_manager->get_document_icon($doc->type); ?></span>
                                <span class="doc-title"><?php echo esc_html($doc->title); ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p>No recent documents</p>
                <?php endif; ?>
            </div>
            
            <div class="widget publication-stats">
                <h3>Publication Statistics</h3>
                <?php
                $pub_tracker = new GEM_Publication_Tracker();
                $stats = $pub_tracker->get_publication_stats();
                ?>
                <div class="stats-grid">
                    <div class="stat-item">
                        <span class="stat-value"><?php echo esc_html($stats['total_publications']); ?></span>
                        <span class="stat-label">Total Publications</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value"><?php echo esc_html($stats['total_citations']); ?></span>
                        <span class="stat-label">Total Citations</span>
                    </div>
                    <div class="stat-item">
                        <span class="stat-value"><?php echo esc_html($stats['h_index']); ?></span>
                        <span class="stat-label">h-index</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>