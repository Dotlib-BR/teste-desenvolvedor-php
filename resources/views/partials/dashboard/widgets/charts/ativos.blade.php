 <!-- Two grid columns -->
 <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
                <!-- Active users chart -->
                <div class="col-span-1 bg-white rounded-md dark:bg-darker">
                  <!-- Card header -->
                  <div class="p-4 border-b dark:border-primary">
                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Clientes ativos agora( Não Implementado)</h4>
                  </div>
                  <p class="p-4">
                    <span class="text-2xl font-medium text-gray-500 dark:text-light" id="usersCount">0</span>
                    <span class="text-sm font-medium text-gray-500 dark:text-primary">Clientes</span>
                  </p>
                  <!-- Chart -->
                  <div class="relative p-4">
                    <canvas id="activeUsersChart"></canvas>
                  </div>
                </div>