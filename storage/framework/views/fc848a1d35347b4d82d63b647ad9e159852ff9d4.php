<?php if(!$view->shared('javascript', false)): ?>

    <?php if($view->share('javascript', true)): ?> <?php endif; ?>

    <?php if($options['async']): ?>

        <script type="text/javascript">

            var initialize_items = [];

            function initialize_method() {
                initialize_items.forEach(function(item) {
                    item.method();
                });
            }

        </script>
        
        <script async defer type="text/javascript" src="//maps.googleapis.com/maps/api/js?v=<?php echo $options['version']; ?>&region=<?php echo $options['region']; ?>&language=<?php echo $options['language']; ?>&key=<?php echo $options['key']; ?>&libraries=places&callback=initialize_method"></script>

    <?php else: ?>

        <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?v=<?php echo $options['version']; ?>&region=<?php echo $options['region']; ?>&language=<?php echo $options['language']; ?>&key=<?php echo $options['key']; ?>&libraries=places"></script>

    <?php endif; ?>

    <?php if($options['cluster']): ?>

        <script type="text/javascript" src="//googlearchive.github.io/js-marker-clusterer/src/markerclusterer.js"></script>

    <?php endif; ?>

<?php endif; ?>
<?php /**PATH /Users/wbr/Sites/wbr_backend/resources/views/cornford/googlmapper/javascript.blade.php ENDPATH**/ ?>