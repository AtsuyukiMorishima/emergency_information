

<?php $__env->startSection('title',  "災害情報ポータルサイト"); ?>

<?php $__env->startSection('body_id', 'event-urledit'); ?>

<?php $__env->startSection('navbar'); ?>
    <span>
        <a href="<?php echo e(route('event.index')); ?>">
            <i class="fas fa-lg fa-arrow-left text-light"></i>
        </a>
    </span>
    <span class="navbar-brand mx-0 text-center text-light">
    災害Event   
        <br class="d-sm-none">
        ページ
    </span>
    <span></span>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contents'); ?>
    <div class="card shadow">
        <div class="card-body">
            <p class="card-text text-secondary">
            <div class="container">
                  <div>
                    <h2 style="text-align:center;">災害Eventページ</h2>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">追加</button>
                  </div>
                  <table class="table table-bordered" style="text-align:center;overflow-wrap:anywhere;}">
                    <thead class="table-primary">
                      <tr>
                         <th>タイトル</th>
                         <th>URL</th>
                         <th>災害名</th>
                         <th>編集</th>
                      </tr>
                    </thead>
                    <?php $__empty_1 = true; $__currentLoopData = $SiteUrls->sortByDesc('registration_date'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $siteUrl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tbody>
                      <tr style="overflow-wrap:anywhere;">
                         <td><?php echo e($siteUrl->site_title); ?></td>
                         <td><?php echo e($siteUrl->URL); ?></td>
                         <td><?php echo e($siteUrl->site_name); ?></td>
                         <td>
                            <div class="btn-group btn-group-sm">
                                <a class="btn btn-success" data-toggle="modal" data-target="#myModal-<?php echo e($siteUrl->site_id); ?>">変更</a>
                                
                                <div class="modal" id="myModal-<?php echo e($siteUrl->site_id); ?>">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                    <form action="/urledit" method="POST" class="form-group">
                                        <?php echo csrf_field(); ?>
                                     <!-- Modal Header -->
                                     <div class="modal-header">
                                       <h4 class="modal-title">変更</h4>
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                     </div>
        
                                     <!-- Modal body -->
                                     <div class="modal-body">
                                          <div class="form-group">
                                             <label class="form-group-text">Url:</label>
                                             <input type="text" class="form-control" value="<?php echo e($siteUrl->URL); ?>" name="URL">
                                          </div>
                                          <input style="display:none;" value="<?php echo e($siteUrl->site_id); ?>" name="id">
                                          <input style="display:none;" value="<?php echo e($siteUrl->ee_id); ?>" name="ee_id">
                                     </div>
        
                                     <!-- Modal footer -->
                                     <div class="modal-footer">
                                       <button type="submit" class="btn btn-success" data-dismiss="" >変更</button>
                                     </div>
                                     </form>
                                    </div>
                                  </div>
                                </div>
                                                            
                                <button type="button" class="btn btn-danger url-delete-btn" data-ID="<?php echo e($siteUrl->site_id); ?>">削除</button>
                             </div>
                         </td>
                      </tr>
                    </tbody>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <span>No Found.</span>
                    <?php endif; ?>
                  </table>
                  <div class="modal" id="myModal">
                                  <div class="modal-dialog">
                                    <div class="modal-content">
                                    <form action="/urledit/create" method="POST" class="form-group">
                                        <?php echo csrf_field(); ?>
                                     <!-- Modal Header -->
                                     <div class="modal-header">
                                       <h4 class="modal-title">追加</h4>
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                     </div>
        
                                     <!-- Modal body -->
                                     <div class="modal-body">
                                          <div class="form-group">
                                             <label class="form-group-text">日付:</label>
                                             <input type="date" class="form-control" name="registration_date">
                                          </div>
                                          <div class="form-group">
                                             <label class="form-group-text">種類:</label>
                                             <select name="event_tag" class="custom-select">
                                               <option value="1">地震</option>
                                               <option value="2">水害</option>
                                               <option value="3">台風</option>
                                             </select>
                                          </div>
                                          <div class="form-group">
                                             <label class="form-group-text">災害名:</label>
                                             <input type="text" class="form-control" name="site_name">
                                          </div>
                                          <div class="form-group">
                                             <label class="form-group-text">Url:</label>
                                             <input type="text" class="form-control" name="URL">
                                          </div>
                                          <div class="form-group">
                                             <label class="form-group-text">タイトル:</label>
                                             <input type="text" class="form-control" name="site_title">
                                          </div>
                                          <input style="display:none;" value="<?php echo e($emergencyEvent); ?>" name="ee_id">
                                     </div>
        
                                     <!-- Modal footer -->
                                     <div class="modal-footer">
                                       <button type="submit" class="btn btn-success" data-dismiss="" >追加</button>
                                     </div>
                                     </form>
                                    </div>
                                  </div>
                                </div>     
            </div>
            </p>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\emergency_information-main\resources\views/event/urledit.blade.php ENDPATH**/ ?>