<?php $__env->startSection('title', '災害情報ポータルサイト'); ?>

<?php $__env->startSection('body_id', 'event-index'); ?>

<?php $__env->startSection('navbar'); ?>
    <span class="navbar-brand mx-0 text-center text-light">災害情報ポータルサイト</span>
    <span></span>
    <span>
        <a href="<?php echo e(route('event.edit')); ?>">
            <i class="fas fa-lg fa-edit text-light"></i>
        </a>
        <a href="<?php echo e(route('event.about')); ?>">
            <i class="fas fa-lg fa-info-circle text-light"></i>
        </a>
    </span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
    <div class="row row-cols-1 row-cols-md-2 mx-0"  id="data-wrapper">
        <!-- Data Loader -->
        <div class="auto-load text-center">
            <svg version="1.1" id="L9" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                x="0px" y="0px" height="60" viewBox="0 0 100 100" enable-background="new 0 0 0 0" xml:space="preserve">
                <path fill="#000"
                    d="M73,50c0-12.7-10.3-23-23-23S27,37.3,27,50 M30.9,50c0-10.5,8.5-19.1,19.1-19.1S69.1,39.5,69.1,50">
                    <animateTransform attributeName="transform" attributeType="XML" type="rotate" dur="1s"
                        from="0 50 50" to="360 50 50" repeatCount="indefinite" />
                </path>
            </svg>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
    
    var ENDPOINT = "<?php echo e(url('/')); ?>";
    var page = 1;
    infinteLoadMore(page);
    $('.auto-load').hide();

    $(window).scroll(function () {
        if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
            page++;
            infinteLoadMore(page);
        }
    });

    function infinteLoadMore(page) {
        $.ajax({
                url: ENDPOINT + "?page=" + page,
                datatype: "html",
                type: "get",
                beforeSend: function () {
                    $('.auto-load').show();
                }
            })
            .done(function (response) {
                if (response.length == 0) {
                    $('.auto-load').html("We don't have more data to display :(");
                    return;
                }
                $('.auto-load').hide();
                
                $("#data-wrapper").append(response);
            })
            .fail(function (jqXHR, ajaxOptions, thrownError) {
                console.log('Server error occured');
            });
    }
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\emergency-compelete\resources\views/event/index.blade.php ENDPATH**/ ?>