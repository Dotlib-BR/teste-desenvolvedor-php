 <!-- Doughnut chart card -->
 <div class="bg-white rounded-md dark:bg-darker" x-data="{ isOn: false }">
                  <!-- Card header -->
                  <div class="flex items-center justify-between p-4 border-b dark:border-primary">
                    <h4 class="text-lg font-semibold text-gray-500 dark:text-light">{{auth()->user()->utype ==="ADM" ? 'Produtos Por Categorias ' : 'Categorias Que Mais Comprei '}}(Não Implementado)</h4>
                    <div class="flex items-center">
                      <button
                        class="relative focus:outline-none"
                        x-cloak
                        @click="isOn = !isOn; $parent.updateDoughnutChart(isOn)"
                      >
                        <div
                          class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker"
                        ></div>
                        <div
                          class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm"
                          :class="{ 'translate-x-0  bg-white dark:bg-primary-100': !isOn, 'translate-x-6 bg-primary-light dark:bg-primary': isOn }"
                        ></div>
                      </button>
                    </div>
                  </div>
                  <!-- Chart -->
                  <div class="relative p-4 h-72">
                    <canvas id="doughnutChart"></canvas>
                  </div>
                </div>
              </div>