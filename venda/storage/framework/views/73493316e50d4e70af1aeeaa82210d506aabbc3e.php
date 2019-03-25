<?php /* /home/vagrant/Trabalhos/desafio/teste-desenvolvedor-backend/venda/resources/views/clientes/listar.blade.php */ ?>


<?php $__env->startSection('content'); ?>
<?php $__env->startSection('pagina', 'Clientes'); ?>
<hr>

<div class="row">
    <div class="col-md-4">
        <button data-toggle="modal" data-target="#cadastrarModal" class="btn btn-primary btn-xs"><b>+</b> Cadastrar </button>
    </div>
  
    <div class="col-md-4">
        <select class="form-control float-right" id="paginacao">
            <option>Paginação</option>
            <option>5</option>
            <option>10</option>
            <option>15</option>
            <option>20</option>
        </select>
    </div>
    <div class="col-md-4">
        <form action="<?php echo e(route('search')); ?>" method="GET">
            <div class="row">
                <div class="col-md-10">
                    <input class="form-control float-right" type="text" name="buscar">                     
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-xs float-right" style="margin-top:5px;"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php $__env->startSection('mensagem'); ?>
<?php $__env->stopSection(); ?>
    <table class="table table-striped mt-3" id="listCli">
        <thead>
            <tr>
                <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('nome', 'Nome'));?></th>
                <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('email', 'E-mail'));?></th>
                <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('cpf', 'CPF'));?></th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
            <?php if(count($clientes)>0): ?>
            <?php $__currentLoopData = $clientes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cliente): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($cliente->nome); ?></td>
                <td><?php echo e($cliente->email); ?></td>
                <td><?php echo e($cliente->cpf); ?></td>
                <td class="text-center">
                    <form action="<?php echo e(route('clientes.destroy', $cliente->id)); ?>" method="post">
                        <a href="<?php echo e(route('clientes.show', $cliente->id)); ?>" class='btn btn-info btn-xs'><i class="far fa-edit"></i></a> 
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-xs"><i class="far fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <tr>
                <td  colspan="4">Nenhum cliente localizado!</td>
            </tr>
            <?php endif; ?>
    </table>
    <?php echo $clientes->appends(request()->input())->links(); ?>


<?php $__env->stopSection(); ?>   
       
<!-- Modal -->
<div class="modal fade" id="cadastrarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cadastro de Estudante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo e(route('clientes.store')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label for="inputEmail4">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                </div>
                <div class="form-group">
                    <label for="inputPassword4">email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="inputPassword4">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                </form>
            </div>

        </div>
    </div>
</div>


<?php echo $__env->make('templates.mensagem', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('templates.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>