<header class="navigation fixed-top">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <a class="navbar-brand font-tertiary h3" href="{{ url('/') }}">
       Quem Procura Acha
    </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
        aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse text-center" id="navigation">
        @component('components.nav')

        @endcomponent
      </div>
    </nav>
  </header>
