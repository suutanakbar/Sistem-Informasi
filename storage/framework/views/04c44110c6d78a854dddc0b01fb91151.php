
<?php $__env->startSection('title', 'Agenda Kegiatan - SI Ormada Temanggung'); ?>
<?php $__env->startSection('content'); ?>
    <section class="bg-white">
        <div class="max-w-7xl mx-auto px-4">

            <div class="border-t border-b border-gray-300 py-8 mb-12">
                <div class="flex items-start justify-between">
                    <div>
                        <div class="text-[10px] font-bold uppercase tracking-[3px] text-gray-500 mb-2">EDISI 005 / 2026</div>
                        <h1 class="text-4xl lg:text-5xl font-black uppercase" style="font-family:'Playfair Display',serif;">Agenda Kegiatan</h1>
                    </div>
                    <p class="hidden lg:block text-sm text-gray-600 max-w-sm text-right">
                        Daftar kegiatan dan acara yang akan dilaksanakan oleh pemda.
                    </p>
                </div>
            </div>

            
            <div class="flex justify-between items-center mb-6">
                
                <div class="flex gap-2">
                    <a href="<?php echo e(route('public.agenda', ['tab' => 'mendatang'])); ?>" 
                       class="px-4 py-2 text-sm font-bold <?php echo e($currentTab === 'mendatang' ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-700'); ?>">
                        Mendatang
                    </a>
                    <a href="<?php echo e(route('public.agenda', ['tab' => 'arsip'])); ?>" 
                       class="px-4 py-2 text-sm font-bold <?php echo e($currentTab === 'arsip' ? 'bg-gray-900 text-white' : 'bg-gray-200 text-gray-700'); ?>">
                        Arsip
                    </a>
                </div>

                
                <?php if($currentTab === 'mendatang'): ?>
                <div class="flex gap-2">
                    <button id="btn-list" class="px-4 py-2 text-sm font-bold bg-gray-900 text-white">List</button>
                    <button id="btn-calendar" class="px-4 py-2 text-sm font-bold bg-gray-200 text-gray-700">Calendar</button>
                </div>
                <?php endif; ?>
            </div>

            
            <div id="list-view">
            <?php if($agendas->isNotEmpty()): ?>
            <div class="columns-1 md:columns-2 xl:columns-3 gap-6 pb-16">
                <?php $__currentLoopData = $agendas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $agenda): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="break-inside-avoid mb-6 bg-white border border-gray-200 group">
                    <a href="<?php echo e(route('public.agenda.show', $agenda)); ?>" class="block">
                        <?php if($agenda->gambar_poster): ?>
                        <div class="w-full overflow-hidden">
                            <img src="<?php echo e(asset('storage/' . $agenda->gambar_poster)); ?>" alt="<?php echo e($agenda->nama_agenda); ?>" class="w-full h-auto object-cover transition duration-500 group-hover:opacity-90">
                        </div>
                        <?php endif; ?>
                        <div class="p-4">
                            <!-- Badges -->
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-[10px] font-bold uppercase tracking-wider text-blue-700">
                                    <?php echo e(str_replace('_', ' ', $agenda->kategori)); ?>

                                </span>
                                <?php if($agenda->kuota_volunteer): ?>
                                <span class="text-[10px] font-bold uppercase tracking-wider text-green-700">Volunteer</span>
                                <?php endif; ?>
                            </div>

                            <!-- Title -->
                            <h3 class="text-base font-black leading-tight mb-2 group-hover:text-blue-700 transition" style="font-family:'Playfair Display',serif;">
                                <?php echo e($agenda->nama_agenda); ?>

                            </h3>

                            <!-- Summary -->
                            <p class="text-gray-600 leading-5 text-xs mb-3">
                                <?php echo e(\Illuminate\Support\Str::limit(strip_tags($agenda->deskripsi_agenda), 150)); ?>

                            </p>

                            <!-- Location -->
                            <div class="text-[10px] font-bold text-gray-500 uppercase tracking-wider mb-2">
                                📍 <?php echo e($agenda->tempat); ?>

                            </div>

                            <!-- Date -->
                            <div class="flex items-center gap-1 text-[10px] text-gray-500 mb-2 uppercase tracking-widest">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <?php echo e($agenda->waktu_mulai->format('d M Y H:i')); ?> WIB
                            </div>

                            <?php if($agenda->kuota_volunteer): ?>
                            <div class="text-[10px] text-gray-500 mb-3">
                                Kuota: <?php echo e($agenda->kuota_volunteer); ?> volunteers
                            </div>
                            <?php endif; ?>

                            <!-- Footer -->
                            <div class="pt-3 border-t border-gray-200">
                                <span class="inline-flex items-center px-4 py-1.5 border border-gray-900 rounded-full text-[10px] font-bold uppercase tracking-wider text-gray-900 group-hover:bg-gray-900 group-hover:text-white transition">
                                    Detail
                                </span>
                            </div>
                        </div>
                    </a>
                </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php endif; ?>
            </div>

            
            <div id="calendar-view" class="hidden pb-16">
                <div id="calendar"></div>
            </div>

        </div>
    </section>

    <?php $__env->startPush('scripts'); ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const listView = document.getElementById('list-view');
        const calendarView = document.getElementById('calendar-view');
        const btnList = document.getElementById('btn-list');
        const btnCalendar = document.getElementById('btn-calendar');
        
        let calendar = null;
        
        // Toggle List View
        btnList.addEventListener('click', function() {
            listView.classList.remove('hidden');
            calendarView.classList.add('hidden');
            btnList.classList.add('bg-gray-900', 'text-white');
            btnList.classList.remove('bg-gray-200', 'text-gray-700');
            btnCalendar.classList.add('bg-gray-200', 'text-gray-700');
            btnCalendar.classList.remove('bg-gray-900', 'text-white');
        });
        
        // Toggle Calendar View
        btnCalendar.addEventListener('click', function() {
            listView.classList.add('hidden');
            calendarView.classList.remove('hidden');
            btnCalendar.classList.add('bg-gray-900', 'text-white');
            btnCalendar.classList.remove('bg-gray-200', 'text-gray-700');
            btnList.classList.add('bg-gray-200', 'text-gray-700');
            btnList.classList.remove('bg-gray-900', 'text-white');
            
            // Initialize calendar on first click
            if (!calendar) {
                calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                    initialView: 'dayGridMonth',
                    events: '<?php echo e(route("public.agenda.calendar")); ?>',
                    eventClick: function(info) {
                        // Skip deadline events (background events)
                        if (info.event.extendedProps.type === 'deadline') {
                            return;
                        }
                        // Navigate to agenda detail page using event URL
                        if (info.event.url) {
                            window.location.href = info.event.url;
                        }
                    },
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    }
                });
                calendar.render();
            }
        });
    });
    </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\project\magang\resources\views/public/agenda.blade.php ENDPATH**/ ?>