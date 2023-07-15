<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All answers for my questions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach($answers as $answer)
                <article class="m-4 rounded-xl bg-white dark:bg-gray-800 shadow-sm text-gray-900 dark:text-gray-100">
                    <div class="flex items-start gap-4 p-4 sm:p-6 lg:p-8">
                        <div>
                            <h2 class="underline font-medium text-xl">{{ $answer->question->question }}</h2>

                            <p class="mt-2 text-sm">
                                {{ $answer->answer }}
                            </p>

                            <div class="mt-2 sm:flex sm:items-center sm:gap-2">
                                <p class="hidden sm:block sm:text-xs">
                                   {{ __('By') . ' ' . $answer->user->name }}
                                </p>

                                <span class="hidden sm:block" aria-hidden="true">&middot;</span>

                                <p class="hidden sm:block sm:text-xs">
                                    {{ $answer->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</x-app-layout>
