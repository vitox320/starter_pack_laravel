<x-mail::message>
    Usuário Criado com sucesso

    <x-mail::button :url="''" color="green">
        Botão de teste
    </x-mail::button>

    <x-mail::panel>
        Seja Bem Vindo ao nosso site {{ config('app.name') }}.
    </x-mail::panel>


</x-mail::message>
