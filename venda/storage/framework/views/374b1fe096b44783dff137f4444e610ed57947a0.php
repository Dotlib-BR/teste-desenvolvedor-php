<?php /* /home/vagrant/Trabalhos/desafio/teste-desenvolvedor-backend/venda/vendor/laravel/framework/src/Illuminate/Pagination/resources/views/bootstrap-4.blade.php */ ?>
<?php if($paginator->hasPages()): ?>
    <ul class="pagination" role="navigation">
        
        <?php if($paginator->onFirstPage()): ?>
            <li class="page-item disabled" aria-disabled="true" aria-label="<?php echo app('translator')->getFromJson('pagination.previous'); ?>">
                <span class="page-link" aria-hidden="true">&lsaquo;</span>
            </li>
        <?php else: ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($paginator->previousPageUrl()); ?>" rel="prev" aria-label="<?php echo app('translator')->getFromJson('pagination.previous'); ?>">&lsaquo;</a>
            </li>
        <?php endif; ?>

        
        <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <?php if(is_string($element)): ?>
                <li class="page-item disabled" aria-disabled="true"><span class="page-link"><?php echo e($element); ?></span></li>
            <?php endif; ?>

            
            <?php if(is_array($element)): ?>
                <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($page == $paginator->currentPage()): ?>
                        <li class="page-item active" aria-current="page"><span class="page-link"><?php echo e($page); ?></span></li>
                    <?php else: ?>
                        <li class="page-item"><a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a></li>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        
        <?php if($paginator->hasMorePages()): ?>
            <li class="page-item">
                <a class="page-link" href="<?php echo e($paginator->nextPageUrl()); ?>" rel="next" aria-label="<?php echo app('translator')->getFromJson('pagination.next'); ?>">&rsaquo;</a>
            </li>
        <?php else: ?>
            <li class="page-item disabled" aria-disabled="true" aria-label="<?php echo app('translator')->getFromJson('pagination.next'); ?>">
                <span class="page-link" aria-hidden="true">&rsaquo;</span>
            </li>
        <?php endif; ?>
    </ul>
<?php endif; ?>
