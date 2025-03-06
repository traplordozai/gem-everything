(function($) {
    'use strict';

    // Refresh dashboard stats periodically
    function refreshDashboardStats() {
        if (!$('.gem-app-dashboard').length) {
            return;
        }

        $.ajax({
            url: gemAppAdmin.ajaxUrl,
            type: 'POST',
            data: {
                action: 'gem_app_refresh_stats',
                nonce: gemAppAdmin.nonce
            },
            success: function(response) {
                if (response.success && response.data) {
                    updateDashboardStats(response.data);
                }
            }
        });
    }

    // Update dashboard stats in the DOM
    function updateDashboardStats(stats) {
        $('.gem-app-stat-value').each(function() {
            const $stat = $(this);
            const key = $stat.data('stat-key');
            if (stats[key] !== undefined) {
                $stat.text(stats[key]);
            }
        });

        if (stats.recent_activity) {
            updateActivityList(stats.recent_activity);
        }
    }

    // Update activity list in the DOM
    function updateActivityList(activities) {
        const $list = $('.gem-app-activity-list');
        if (!activities.length) {
            $list.html('<p>No recent activity to display.</p>');
            return;
        }

        const html = activities.map(activity => `
            <div class="gem-app-activity-item">
                <span class="activity-type">${activity.type}</span>
                <span class="activity-description">${activity.description}</span>
                <span class="activity-time">${activity.time_ago} ago</span>
            </div>
        `).join('');

        $list.html(html);
    }

    // Initialize dashboard
    $(document).ready(function() {
        if ($('.gem-app-dashboard').length) {
            // Refresh stats every 60 seconds
            setInterval(refreshDashboardStats, 60000);
        }
    });

})(jQuery);