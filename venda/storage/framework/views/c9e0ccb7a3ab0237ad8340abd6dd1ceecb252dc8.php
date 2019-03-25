<?php /* /home/vagrant/Trabalhos/desafio/teste-desenvolvedor-backend/venda/resources/views/produtos/editar.blade.php */ ?>


<?php $__env->startSection('content'); ?>
<?php $__env->startSection('pagina', 'Produtos'); ?>
<form method="POST" action="<?php echo e(route('produtos.update', $produtos->id)); ?>">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <div class="form-group">
        <label for="inputEmail4">Produto</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo e($produtos->nome); ?>">
    </div>
    <div class="form-group">
        <label for="inputPassword4">Cód. Barra</label>
        <input type="text" class="form-control" id="codBarras" name="codBarras" value="<?php echo e($produtos->codBarras); ?>">
    </div>
    <div class="form-group">
        <label for="inputPassword4">Valor</label>
        <input type="text" class="form-control" id="valor" name="valor" value="<?php echo e($produtos->valor); ?>">
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Salvar</button>
    </div>
</form>

<?php $__env->stopSection(); ?> 
<?php echo $__env->make('templates.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>