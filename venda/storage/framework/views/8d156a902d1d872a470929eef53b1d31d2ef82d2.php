<?php /* /home/vagrant/Trabalhos/desafio/teste-desenvolvedor-backend/venda/vendor/laravel/framework/src/Illuminate/Foundation/Exceptions/views/404.blade.php */ ?>
<?php $__env->startSection('title', __('Not Found')); ?>
<?php $__env->startSection('code', '404'); ?>
<?php $__env->startSection('message', __('Not Found')); ?>

<?php echo $__env->make('errors::minimal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>