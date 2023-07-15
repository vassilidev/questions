<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('status') === 'answer-stored')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 4000)"
                    class="text-sm text-green-600 dark:text-green-400"
                >{{ __('Answers submitted.') }}</p>
            @endif

            @if($question)
                <div class="mb-12 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                                {{ __('Answer this question !') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                {{ __("By") . ' ' . $question->user->name }}
                            </p>
                        </header>

                        <form method="post" action="{{ route('answers.store') }}" class="mt-6 space-y-6">
                            @csrf
                            <input type="hidden" name="question_id" value="{{ $question->id }}">

                            <div>
                                <x-input-label for="answer" :value="$question->question"/>

                                <x-textarea id="answer" name="answer" class="mt-1 block w-full"
                                            required
                                            autofocus/>
                                <x-input-error class="mt-2" :messages="$errors->get('answer')"/>
                            </div>

                            <x-primary-button>{{ __('Answer') }}</x-primary-button>
                        </form>
                    </div>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            {{ __('Create a question') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            {{ __("When you create a question it will be asked in random order to all users of the platform!") }}
                        </p>
                    </header>

                    <form method="post" action="{{ route('questions.store') }}" class="mt-6 space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="question" :value="__('Question')"/>
                            <x-textarea id="question" name="question" class="mt-1 block w-full" required
                                        autofocus/>
                            <x-input-error class="mt-2" :messages="$errors->get('question')"/>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Create') }}</x-primary-button>

                            @if (session('status') === 'question-created')
                                <p
                                    x-data="{ show: true }"
                                    x-show="show"
                                    x-transition
                                    x-init="setTimeout(() => show = false, 4000)"
                                    class="text-sm text-green-600 dark:text-green-400"
                                >{{ __('Question created.') }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
