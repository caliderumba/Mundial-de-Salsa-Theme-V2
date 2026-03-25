(function($) {
    'use strict';

    $(document).ready(function() {
        const $container = $('#live-timeline-container');
        const $refreshBtn = $('#refresh-live-timeline');

        if (!$container.length) return;

        function fetchLiveUpdates() {
            $refreshBtn.addClass('animate-spin');
            
            $.ajax({
                url: mdsLive.ajaxUrl,
                type: 'POST',
                data: {
                    action: 'mds_get_live_updates',
                    nonce: mdsLive.nonce,
                    post_id: mdsLive.postId
                },
                success: function(response) {
                    if (response.success) {
                        $container.html(response.data.html);
                    }
                },
                complete: function() {
                    $refreshBtn.removeClass('animate-spin');
                }
            });
        }

        // Auto-refresh every 60 seconds
        setInterval(fetchLiveUpdates, 60000);

        // Manual refresh
        $refreshBtn.on('click', function(e) {
            e.preventDefault();
            fetchLiveUpdates();
        });
    });

})(jQuery);
