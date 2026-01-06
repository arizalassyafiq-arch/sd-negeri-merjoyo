 <nav class="fixed w-full z-50 top-6 px-4 sm:px-8">
     <div
         class="max-w-7xl mx-auto bg-white/90 dark:bg-surface-dark/90 backdrop-blur-md rounded-full shadow-lg px-8 py-4 flex flex-col md:flex-row justify-between items-center transition-all duration-300 gap-4 md:gap-0">
         <div class="flex items-center w-full md:w-auto justify-between md:justify-start space-x-8">
             <div class="flex items-center space-x-6">
                 <a class="text-text-primary-light dark:text-text-primary-dark font-medium hover:text-primary transition-colors"
                     href="#">Beranda</a>
                 <a class="text-text-primary-light dark:text-text-primary-dark font-medium hover:text-primary transition-colors"
                     href="#">Artikel</a>
                 <a class="text-text-primary-light dark:text-text-primary-dark font-medium hover:text-primary transition-colors"
                     href="#">Cari Siswa</a>
                 <button
                     class="text-text-primary-light dark:text-text-primary-dark font-medium hover:text-primary transition-colors flex items-center gap-1 focus:outline-none"
                     onclick="toggleChat()">
                     Diskusi
                     <span class="relative flex h-2 w-2">
                         <span
                             class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                         <span class="relative inline-flex rounded-full h-2 w-2 bg-red-500"></span>
                     </span>
                 </button>
             </div>
             <div class="flex md:hidden items-center text-primary">
                 <span class="material-icons">school</span>
             </div>
         </div>
         <div class="hidden md:flex items-center space-x-4 shrink-0">
             <button
                 class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-300 transition-colors"
                 onclick="document.documentElement.classList.toggle('dark')">
                 <span class="material-icons dark:hidden">dark_mode</span>
                 <span class="material-icons hidden dark:block">light_mode</span>
             </button>
             <div class="flex items-center font-bold text-xl text-primary">
                 <span class="material-icons mr-2">school</span>
                 SDN Merjoyo
             </div>
         </div>
     </div>
 </nav>
