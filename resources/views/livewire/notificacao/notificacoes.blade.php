
<div wire:poll.200ms>
@if(Auth::user()->unreadNotifications)
<button  wire:click="marcarLido" class="bg-blue-500 px-4 py-2 text-xs font-semibold tracking-wider text-white rounded hover:bg-blue-600">Marcar Todos como Lido</button>
            
@foreach(Auth::user()->unreadNotifications as $notification)

  
<a href="#" class="block">
                  <div class="flex px-4 space-x-4">
                    <div class="relative flex-shrink-0">
                      <span
                        class="z-10 inline-block p-2 overflow-visible rounded-full bg-primary-50 text-primary-light dark:bg-primary-darker"
                      >
                        <svg
                          class="w-7 h-7"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"
                          />
                        </svg>
                      </span>
                      <div class="absolute h-24 p-px -mt-3 -ml-px bg-primary-50 left-1/2 dark:bg-primary-darker"></div>
                    </div>
                    <div class="flex-1 overflow-hidden">
                      <h5 class="text-sm font-semibold text-gray-600 dark:text-light">
                      {{ $notification->data['subject'] }}
                      </h5>
                      @if(Auth::user()->utype==="ADM")
                      <p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                      {{ $notification->data['greeting'] }}
                      </p>
                      @else
                        <p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                      {{ $notification->data['body'] }}
                      </p>
                      @endif
                      <span class="text-sm font-normal text-gray-400 dark:text-primary-light"> 9h ago </span>
                    </div>
                  </div>
                </a>

@endforeach

@else
<p class="text-sm font-normal text-gray-400 truncate dark:text-primary-lighter">
                      Nenhuma notificação a ser exibida
                      </p>
@endif
</div>