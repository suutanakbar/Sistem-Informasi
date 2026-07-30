<footer class="mt-12 border-t-2 border-black bg-white">

    <div class="max-w-7xl mx-auto px-4 py-8">

        <!-- Logo -->

        <div class="text-center">

            <h2
                class="text-xl lg:text-2xl font-black"
                style="font-family:'Playfair Display',serif;">

                SI ORMADA

            </h2>

            <p
                class="mt-0.5 uppercase tracking-[3px] text-[10px] text-gray-500">

                TEMANGGUNG

            </p>

        </div>


        <!-- Description -->

        <div class="max-w-3xl mx-auto text-center mt-4">

            <p class="text-gray-600 leading-5 text-xs">

                Sistem Informasi Organisasi Mahasiswa Daerah Kabupaten
                Temanggung yang menyediakan informasi berita, agenda,
                profil organisasi mahasiswa, serta layanan aspirasi
                sebagai media komunikasi antara mahasiswa dan pemerintah
                daerah.

            </p>

        </div>


        <!-- Menu -->

        <div
            class="flex flex-wrap justify-center gap-4 mt-6 uppercase tracking-widest text-xs font-semibold">

            <a href="<?php echo e(route('public.home')); ?>"
               class="hover:text-blue-700 transition">

                Beranda

            </a>

            <a href="<?php echo e(route('public.aspirasi')); ?>"
               class="hover:text-blue-700 transition">

                Aspirasi

            </a>

            <a href="<?php echo e(route('public.agenda')); ?>"
               class="hover:text-blue-700 transition">

                Agenda

            </a>

            <a href="<?php echo e(route('public.postingan')); ?>"
               class="hover:text-blue-700 transition">

                Berita

            </a>

            <a href="<?php echo e(route('public.ormada')); ?>"
               class="hover:text-blue-700 transition">

                Profil Ormada

            </a>

        </div>


        <!-- Divider -->

        <div class="border-t border-gray-300 my-6"></div>


        <!-- Bottom -->

        <div
            class="flex flex-col md:flex-row justify-between items-center gap-3 text-xs text-gray-500">

            <div>

                © <?php echo e(date('Y')); ?> SI Ormada Temanggung

            </div>

            <div class="flex gap-4 uppercase tracking-widest text-[10px]">

                <a href="#">Instagram</a>

                <a href="#">Email</a>

                <a href="#">Pemkab Temanggung</a>

            </div>

        </div>

    </div>

</footer><?php /**PATH C:\project\magang\resources\views/components/footer.blade.php ENDPATH**/ ?>