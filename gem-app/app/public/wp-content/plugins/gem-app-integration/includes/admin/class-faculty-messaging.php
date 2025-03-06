class GEM_Faculty_Messaging {
    public function __construct() {
        add_action('wp_ajax_send_message', array($this, 'handle_message_send'));
        add_action('wp_ajax_get_conversations', array($this, 'get_conversations'));
        add_action('wp_ajax_mark_as_read', array($this, 'mark_message_read'));
    }

    public function render_messaging_interface() {
        $conversations = $this->get_recent_conversations();
        
        ?>
        <div class="wrap faculty-messaging">
            <h1>Messages</h1>
            
            <div class="messaging-container">
                <!-- Conversations List -->
                <div class="conversations-list">
                    <div class="search-box">
                        <input type="text" placeholder="Search conversations...">
                    </div>
                    
                    <div class="conversation-items">
                        <?php foreach ($conversations as $conv): ?>
                            <div class="conversation-item <?php echo $conv->unread ? 'unread' : ''; ?>"
                                 data-id="<?php echo esc_attr($conv->id); ?>">
                                <img src="<?php echo esc_url($conv->participant_avatar); ?>" 
                                     alt="<?php echo esc_attr($conv->participant_name); ?>">
                                <div class="conversation-preview">
                                    <h4><?php echo esc_html($conv->participant_name); ?></h4>
                                    <p><?php echo esc_html($conv->last_message); ?></p>
                                </div>
                                <span class="time"><?php echo esc_html($conv->last_time); ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Message Thread -->
                <div class="message-thread">
                    <div class="thread-header"></div>
                    <div class="messages-container"></div>
                    <div class="message-composer">
                        <textarea placeholder="Type your message..."></textarea>
                        <button class="send-message">Send</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    private function get_recent_conversations() {
        $api = gem_app_api();
        return $api->request('/faculty/conversations');
    }
}