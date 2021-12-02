<?php $__env->startSection('title', "{$emergencyEvent->event_title} - 災害情報ポータルサイト"); ?>

<?php $__env->startSection('body_id', 'event-show'); ?>

<?php $__env->startSection('navbar'); ?>
    <span>
        <a href="<?php echo e(route('event.index')); ?>">
            <i class="fas fa-lg fa-arrow-left text-light"></i>
        </a>
    </span>
    <span class="navbar-brand mx-0 text-center text-light">
        <?php echo e($emergencyEvent->event_date->format('n月j日')); ?>

        <br class="d-sm-none">
        <?php echo e($emergencyEvent->event_title); ?>

    </span>
    <span>
        <a href="<?php echo e(route('event.urledit', ['ee_id' => $emergencyEvent->ee_id])); ?>">
            <i class="fas fa-lg fa-edit text-light"></i>
        </a>
    </span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title text-secondary">ニュース一覧</h5>
            <div class="navbar navbar-light bg-light fixed-bottom cust-header navbar-urledit">
           <div class="input-group mt-3 mb-3">
                <div class="input-group-prepend">
                 <form action='<?php echo e($emergencyEvent->ee_id); ?>' method="POST">
                  <?php echo e(csrf_field()); ?>

                   <select type="button" class="form-control btn-primary" id="event_tag" name="event_tag" onchange="this.form.submit()">
                     <!-- <option type="hidden" style="display:none;"></option> -->
                     <option value="0" <?php if($sort==0): ?> selected="selected" <?php endif; ?>>全体</option>
                     <option value="1" <?php if($sort==1): ?> selected="selected" <?php endif; ?>>地震</option>
                     <option value="2" <?php if($sort==2): ?> selected="selected" <?php endif; ?>>水害</option>
                     <option value="3" <?php if($sort==3): ?> selected="selected" <?php endif; ?>>台風</option>
                   </select>
                 </form>
                </div>
                <input type="text" id="myInput" class="form-control" placeholder="検索">
                <div class="input-group-append">
                  <div class="form-group form-check">
                    <div class="row">
                      <div class="col-sm-6">
                        <i class="fas fa-lg fa-thumbs-up text-primary"></i>
                      </div>
                      <div class="col-sm-6">
                       <input type="checkbox" class="form-check-input" name="event_allow">
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
            <ul class="list-group list-group-flush"   id="keyword_serch">
              <?php if($sort==0||null): ?>
                  <?php $__empty_1 = true; $__currentLoopData = $emergencyEvent->SiteUrls->sortByDesc('registration_date'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siteUrl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                  <li class="list-group-item">
                     <div class="row">
                      <div class="col-sm-10" >
                          <div class="container">
                           <div class="media p-3">
                             <a href="<?php echo e($emergencyEvent->event_title); ?>/<?php echo e($siteUrl->URL); ?>" >
                               <img src="img/2.jpg" class="mr-3 rounded-circle" style="width:47px;">
                             </a>
                             <div class="media-body">
                              <h5 class="text-secondary " style="overflow-wrap:anywhere;"><?php echo e($siteUrl->site_name); ?></h5>
                              <h6 class="card-text text-secondary"><?php echo e($siteUrl->site_title); ?></h6>
                              <button class="btn btn-outline-danger allow">
                                <i class="fas fa-lg fa-thumbs-up text-primary"><span class="badge badge-light">4</span></i>
                              </button>
                             </div>
                           </div>
                          </div>
                      </div>
                      <!-- <div class="col-sm-2">
                        <div class="btn-group btn-group-sm">   
                         <button class="btn btn-outline-danger">
                          <i class="fas fa-lg fa-thumbs-up text-primary"><span class="badge badge-light">4</span></i>
                         </button>
                        </div>
                      </div> -->
                     </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li class="list-group-item">
                        <span class="text-secondary">Not found.</span>
                    </li>
                <?php endif; ?>
              <?php else: ?>
                  <?php $__empty_1 = true; $__currentLoopData = $emergencyEvent->SiteUrls->where('event_tag',$sort)->sortByDesc('registration_date'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siteUrl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>              
                    <li class="list-group-item">
                     <div class="row">
                      <div class="col-sm-10" >
                          <div class="container">
                           <div class="media p-3" >
                           <a href="<?php echo e($emergencyEvent->event_title); ?>/<?php echo e($siteUrl->URL); ?>" >
                             <img src="img/2.jpg" class="mr-3 rounded-circle" style="width:47px;">
                           </a>
                             <div class="media-body">
                              <h5 class="text-secondary " style="overflow-wrap:anywhere;"><?php echo e($siteUrl->site_name); ?></h5>
                              <h6 class="card-text text-secondary"><?php echo e($siteUrl->site_title); ?></h6>
                              <button class="btn btn-outline-danger allow">
                                   <i class="fas fa-lg fa-thumbs-up text-primary"><span class="badge badge-light">4</span></i>
                              </button>
                             </div>
                           </div>
                          </div>
                      </div>
                      <!-- <div class="col-sm-2">
                        <div class="btn-group btn-group-sm">   
                         <button class="btn btn-outline-danger">
                          <i class="fas fa-lg fa-thumbs-up text-primary"><span class="badge badge-light">4</span></i>
                         </button>
                        </div>
                      </div> -->
                     </div>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <li class="list-group-item">
                        <span class="text-secondary">Not found.</span>
                    </li>
                <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\emergency_information-main\resources\views/event/show.blade.php ENDPATH**/ ?>