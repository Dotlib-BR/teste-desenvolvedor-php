<?php /* /home/vagrant/Trabalhos/desafio/teste-desenvolvedor-backend/venda/resources/views/pedidos/cadastrar.blade.php */ ?>


<?php $__env->startSection('content'); ?>
<?php $__env->startSection('pagina', 'Pedidos'); ?>
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Dados do Cliente</h5>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="cpf" placeholder="CPF">
                    </div>
                    <div class="col-md-1">
                        <button id="buscaCliente" type="button" class="btn btn-primary ml-2"><i class="fas fa-search"></i></button>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="nome" disabled="disabled">
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="email" disabled="disabled">
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-12">
        <div class="card">
            <h5 class="card-header">Produtos</h5>
            <div class="card-body">
            <form class="">
                <div class="form-row">
                    <div class="col-md-6">
                        <label for="validationCustom02">Produto</label>
                        <select class="form-control" id="produto">
                        <?php if(count($produtos)>0): ?>
                            <?php $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($produto->id); ?>" valor="<?php echo e($produto->valor); ?>"><?php echo e($produto->nome); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <option value="0">Nenhum produto encontrado.</option>
                        <?php endif; ?>
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label for="validationCustomUsername">Quantidade</label>
                        
                        <input type="number" class="form-control" id="qtd" required>
                        <div class="invalid-feedback">
                            Please choose a username.
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button id="adcProduto" class="btn btn-success" style="margin-top: 2rem;" type="button"><strong>+</strong></button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<div class="row mt-3">
    <div class="col-md-8">
        <div class="card">
            <h5 class="card-header"><i class="fas fa-cart-plus"></i> Itens</h5>
            <div class="card-body">
            <div class="table-responsive-md">
                <table class="table">
                    </thead>
                    <tbody id="itens">
                    
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <h5 class="card-header"><i class="far fa-money-bill-alt"></i> Total</h5>
            <div class="card-body">
            
            <div class="panel-body">
                    <div class="col-md-12">
                        <strong>Subtotal </strong>
                        <div class="float-right"><span>R$</span><span id="subtotal"></span></div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <small>Desconto</small>
                        <div class="float-right">
                            <span class="float-right"><strong>%</strong></span>
                            <input id="desconto" type="text" class="form-control float-right" style="width: 40%;">
                            
                        </div>
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <strong>Order Total</strong>
                        <div class="float-right"><span>R$</span><span id="total"></span></div>
                        <hr>
                    </div>
                    
                    <button type="button" class="btn btn-primary btn-lg btn-block">Finalizar</button>
                        
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(url('js/pedidos.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('templates.mensagem', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('templates.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>