

<nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all shadow-none duration-250 ease-soft-in rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="true">
  <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
    <nav>
      <!-- breadcrumb -->
      <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
        <li class="leading-normal text-sm">
          <a class="opacity-50 text-slate-700" href="javascript:;">Pages</a>
        </li>
        <li class="text-sm pl-2 capitalize leading-normal text-slate-700 before:float-left before:pr-2 before:text-gray-600 before:content-['/']" aria-current="page">Dashboard</li>
      </ol>
      <h6 class="mb-0 font-bold capitalize">Dashboard</h6>
    </nav>

    <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
      <div class="flex items-center md:ml-auto md:pr-4">
        <!-- <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease-soft">
                <span class="text-sm ease-soft leading-5.6 absolute z-50 -ml-px flex h-full items-center whitespace-nowrap rounded-lg rounded-tr-none rounded-br-none border border-r-0 border-transparent bg-transparent py-2 px-2.5 text-center font-normal text-slate-500 transition-all">
                  <i class="fas fa-search"></i>
                </span>
                <input type="text" class="pl-8.75 text-sm focus:shadow-soft-primary-outline ease-soft w-1/100 leading-5.6 relative -ml-px block min-w-0 flex-auto rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding py-2 pr-3 text-gray-700 transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none focus:transition-shadow" placeholder="Type here..." />
              </div> -->
      </div>
      <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full">

        <li class="relative flex items-center pr-2">
          <p class="hidden transform-dropdown-show"></p>
          <a href="javascript:;" class="block p-0 transition-all text-sm ease-nav-brand text-slate-500" dropdown-trigger aria-expanded="false">
            <i class="cursor-pointer fa fa-user"></i><?php
                                                      // Vérifiez si les détails de l'utilisateur sont définis
                                                      if (isset($userDetails) && is_array($userDetails)) {
                                                        // Affichez le nom de l'utilisateur
                                                        echo "Bienvenue, " . $userDetails['fullname²'] . "!";
                                                      } else {
                                                        // Gérez le cas où les détails de l'utilisateur ne sont pas disponibles
                                                        echo "Bienvenue!";
                                                      }
                                                      ?>


          </a>

          <ul dropdown-menu class="text-sm transform-dropdown before:font-awesome before:leading-default before:duration-350 before:ease-soft lg:shadow-soft-3xl duration-250 min-w-44 before:sm:right-7.5 before:text-5.5 pointer-events-none absolute right-0 top-0 z-50 origin-top list-none rounded-lg border-0 border-solid border-transparent bg-white bg-clip-padding px-2 py-4 text-left text-slate-500 opacity-0 transition-all before:absolute before:right-2 before:left-auto before:top-0 before:z-50 before:inline-block before:font-normal before:text-white before:antialiased before:transition-all before:content-['\f0d8'] sm:-mr-6 lg:absolute lg:right-0 lg:left-auto lg:mt-2 lg:block lg:cursor-pointer">
            <!-- add show class on dropdown open js -->
            <a class="ease-soft py-1.2 clear-both block w-full whitespace-nowrap rounded-lg bg-transparent px-4 duration-300 hover:bg-gray-200 hover:text-slate-700 lg:transition-colors" href="javascript:;">
              <div class="flex py-1">
                <h6 class="mb-1 font-normal leading-normal text-sm"><span class="font-semibold">Logout</span></h6>
              </div>
            </a>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>