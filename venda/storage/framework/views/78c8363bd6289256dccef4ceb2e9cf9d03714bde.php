<?php /* /home/vagrant/Trabalhos/desafio/teste-desenvolvedor-backend/venda/resources/views/clientes/editar.blade.php */ ?>


<?php $__env->startSection('content'); ?>
<?php $__env->startSection('pagina', 'Clientes'); ?>

    <form method="POST" action="<?php echo e(route('clientes.update', $clientes->id)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="form-group">
            <label for="inputEmail4">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?php echo e($clientes->nome); ?>">
        </div>
        <div class="form-group">
            <label for="inputPassword4">email</label>
            <input type="text" class="form-control" id="email" name="email" value="<?php echo e($clientes->email); ?>">
        </div>
        <div class="form-group">
            <label for="inputPassword4">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="<?php echo e($clientes->cpf); ?>">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
        </form>

<?php $__env->stopSection(); ?>  
<?php echo $__env->make('templates.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>