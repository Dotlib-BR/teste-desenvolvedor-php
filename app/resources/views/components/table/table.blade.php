@props([
    'searchable' => false,
    'pagination',
    'perPage',
    'searchParams' => null
])

<div class="border border-gray-200 rounded-lg" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 2px 0px;box-shadow: rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px;box-shadow: rgba(0, 0, 0, 0.05) 0px 1px 2px 0px;">
    <div class="bg-white w-full p-2  rounded-t-lg flex justify-end border-b border-gray-200">
        @if ($searchable)    
            <div class="relative w-full md:w-auto">
                <div class="absolute flex justify-center items-center w-9 h-9 ">
                    <i class="fa-solid fa-magnifying-glass text-gray-400"></i>
                </div>
                <input type="text" placeholder="Pesquisa" id="table-search"
                    value="{{ $searchParams }}  "
                    class="h-9 pl-9 border rounded-lg placeholder:text-slate-400 w-full
                    transition-all
                    focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500">
            </div>
        @else
            <div class="w-full h-9 p-2">

            </div>
        @endif
    </div>
    <div class="overflow-x-auto">
        <table class="table-auto w-full bg-white min-w-max overflow-x-auto">
            <thead>
                <tr class="bg-gray-50 text-left">
                    {{ $header }}
                </tr>
            </thead>
                <tbody>
                    {{ $body }}
                </tbody>
        </table>
    </div>
    <div class="relative bg-white w-full rounded-b-lg border-gray-200">
        @if($pagination)
            <div class="absolute w-full h-full flex justify-center items-center gap-2">
                    <select id="per_page" name="per_page"
                        class="bg-white border border-gray-300 p-2 rounded-lg shadow-sm" 
                        onchange="changePerPage(this)">

                        
                        <option value="5" {{ $perPage == 5 ? "selected" : "" }}>5</option>
                        <option value="10" {{ $perPage == 10 ? "selected" : "" }}>10</option>
                        <option value="25" {{ $perPage == 25 ? "selected" : "" }}>25</option>
                        <option value="50" {{ $perPage == 50 ? "selected" : "" }}>50</option>
                    </select>
                <label for="per_page" class="text-sm font-extralight">por página</label>
            </div>
            <div class="w-full px-4 py-2">
                {!! $pagination !!}
            </div>
        @else
            <div class="rounded-b-lg h-[54px]"></div>
        @endif
    </div>
    <style>
        thead > tr {
            background-color: #F9FAFB;
        }
        
        th, td {
            padding: 0.5rem 1rem;
            border-width: 1px 0;
            border-color: #e5e7eb;
            text-align: start;
        }
    </style>

    <script>
        const search = document.getElementById('table-search');
        search.addEventListener('keyup', function(e){
            var key = e.which || e.keyCode;
            if (key == 13) {
                performSearch(this.value);
            }
        });

        function changePerPage(selectObject) {
            currentPerPage = {{ $perPage }}
            selected = selectObject.value
            if (selected == currentPerPage) {
                return
            }
            var newURL = updateURLParameter(window.location.href, 'per_page', selected);
            window.location.replace(newURL)
        }

        function performSearch(param) {
            let newURL = updateURLParameter(window.location.href, 'search_params', param)
            window.location.replace(newURL)
        }

        function updateURLParameter(url, param, paramVal){
            var newAdditionalURL = "";
            var tempArray = url.split("?");
            var baseURL = tempArray[0];
            var additionalURL = tempArray[1];
            var temp = "";
            if (additionalURL) {
                tempArray = additionalURL.split("&");
                for (var i=0; i<tempArray.length; i++){
                    if(tempArray[i].split('=')[0] != param){
                        newAdditionalURL += temp + tempArray[i];
                        temp = "&";
                    }
                }
            }

            var rows_txt = temp + "" + param + "=" + paramVal;
            return baseURL + "?" + newAdditionalURL + rows_txt;
        }
         
        function yoo(param) {

            url = new URL(window.location.href);

            url.searchParams.set('order_by', param);
            window.location.replace(url);
        }
    </script>
</div>
