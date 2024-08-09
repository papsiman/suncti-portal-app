<div class="navbar h-[50px] bg-white border border-border">
            <div class="flex-1 -mt-2">
                <div class="flex flex-col items-center justify-center">
                    <!-- Page content here -->
                    <label for="drawer-leftmenu" class="btn btn-white drawer-button xl:hidden">
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            class="inline-block h-5 w-5 stroke-current">
                            <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </label>
                </div>
                <a href="./" class="btn btn-ghost justify-start items-end text-4xl font-semibold">
                    <img src="./public/suncti_logo_2013-removebg.png" alt="" class="w-[100px]" />
                    <div class="divider divider-horizontal"></div>
                    <span class="">Monitoring</span>
                </a>
            </div>
            <div class="flex-none gap-2">
                <div class="dropdown dropdown-end flex flex-row justify-end items-center gap-2">
                    <div>
                        <button class="btn bth-ghost"><?php echo isset($_SESSION["User"]) ? $_SESSION["User"] : '' ; ?></button>
                    </div>
                    <div>
                        <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                            <div class="rounded-full bg-neutral text-neutral-content w-24 text-2xl text-center">
                                <i class="fa-solid fa-user mt-[7px]"></i>
                            </div>
                        </div>
                        <ul tabindex="0" class="menu menu-sm dropdown-content bg-base-100 z-[1] mt-4 p-4 shadow-sm">
                            <li>
                                <a href="./logout.php" class=""><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a>
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>
</div>
