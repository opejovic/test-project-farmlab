                      <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="true" aria-expanded="false">Farmer</a>

                            <div id="dropdown-menu" class="dropdown-menu" style="height: 200px;">
                                
                                <input class="dropdown-item" type="text" placeholder="Search.." id="myInput" onkeyup="filterFunction()">
                                <div class="dropdown-divider"></div>

                                @foreach ($farmers as $farmer)
                                    <a class="dropdown-item" href="{{ route('labresults.farmer', $farmer->farmer_name) }}">{{ $farmer->farmer_name }}</a>
                                @endforeach
                            </div>
                        </li>


                    {{-- Filter farmers in the dropdown menu --}}
                    <script type="application/javascript">
                        function filterFunction() {
                            var input, filter, ul, li, a, i;
                            input = document.getElementById("myInput");
                            filter = input.value.toUpperCase();
                            div = document.getElementById("dropdown-menu");
                            a = div.getElementsByTagName('a');
                            for (i = 0; i < a.length; i++) {
                                if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                                    a[i].style.display = '';
                                } else {
                                    a[i].style.display = 'none';
                                }
                            }
                        }
                    </script>