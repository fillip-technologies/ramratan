 <div class="relative w-full">
     <div class="flex border border-gray-300 rounded-lg px-3 py-2 items-center shadow-sm hover:shadow-md transition">

    <form action="{{ route('search.product') }}" method="GET" class="flex w-full items-center">

        <input
            id="searchInput"
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Search Products"
            class="flex-1 text-sm focus:outline-none bg-transparent"
        />
        <button type="submit" class="text-gray-400 hover:text-pink-500 transition px-2">
            <i class="fas fa-search"></i>
        </button>

    </form>

</div>


     <!-- Dropdown -->
     <div id="searchDropdown"
         class="absolute left-0 w-full  top-full bg-white border border-gray-300 shadow-lg mt-1 hidden z-50">

         <div class="grid grid-cols-2 gap-4 p-4">
             <!-- Suggestions -->
             <div>
                 <h3 class="text-gray-500 text-sm mb-2">Suggestions</h3>
                 <ul class="space-y-2 text-gray-700 text-sm">
                     <li class="hover:text-pink-500 cursor-pointer">diamond ring</li>
                     <li class="hover:text-pink-500 cursor-pointer">silver diamond studs for men</li>
                     <li class="hover:text-pink-500 cursor-pointer">lab grown diamonds ring</li>
                     <li class="hover:text-pink-500 cursor-pointer">sui dhaaga</li>
                     <li class="hover:text-pink-500 cursor-pointer">Next Day Delivery</li>
                     <li class="hover:text-pink-500 cursor-pointer">CRED Dazzling Diwali</li>
                     <li class="hover:text-pink-500 cursor-pointer">Diva Desire Collection</li>
                 </ul>
             </div>

             <!-- Products -->
             <div>
                 <h3 class="text-gray-500 text-sm mb-2">Products</h3>
                 <ul class="space-y-4 text-sm">
                     <li class="flex space-x-3 items-start">
                         <img src="https://images.unsplash.com/photo-1573408301185-9146fe634ad0?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTF8fGpld2VsbGVyeXxlbnwwfHwwfHx8MA%3D%3D"
                             class="w-10 h-10 object-contain" />
                         <div>
                             <p>Rose Gold Dreamy Crush Dainty Stud Earrings</p>
                             <p class="text-pink-600 font-semibold">₹1,299 <span
                                     class="line-through text-gray-400 text-xs">₹1,999</span></p>
                         </div>
                     </li>
                     <li class="flex space-x-3 items-start">
                         <img src="https://images.unsplash.com/photo-1535632787350-4e68ef0ac584?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTl8fGpld2VsbGVyeXxlbnwwfHwwfHx8MA%3D%3D"
                             class="w-10 h-10 object-contain" />
                         <div>
                             <p>Silver Zircon Drizzle Drop Earrings</p>
                             <p class="text-pink-600 font-semibold">₹2,099 <span
                                     class="line-through text-gray-400 text-xs">₹2,799</span></p>
                         </div>
                     </li>
                     <li class="flex space-x-3 items-start">
                         <img src="https://images.unsplash.com/photo-1603561591411-07134e71a2a9?w=600&auto=format&fit=crop&q=60&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8cmluZ3xlbnwwfHwwfHx8MA%3D%3D"
                             class="w-10 h-10 object-contain" />
                         <div>
                             <p>Silver Drizzle Drop Pendant with Box Chain</p>
                             <p class="text-pink-600 font-semibold">₹2,399 <span
                                     class="line-through text-gray-400 text-xs">₹3,599</span></p>
                         </div>
                     </li>
                 </ul>
             </div>
         </div>


         <div class="border-t px-4 py-2 text-sm text-gray-700 flex justify-between items-center">
             <span>Search for “<span id="searchText"></span>”</span>
             <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
         </div>
     </div>
 </div>


 <script>
     const input = document.getElementById("searchInput");
     const dropdown = document.getElementById("searchDropdown");
     const searchText = document.getElementById("searchText");

     input.addEventListener("input", () => {
         if (input.value.trim() !== "") {
             dropdown.classList.remove("hidden");
             searchText.textContent = input.value;
         } else {
             dropdown.classList.add("hidden");
         }
     });
 </script>
