<x-email::message>
    Usuário Criado com sucesso

    @component('mail::button',['color'=> 'green'])
        Botão de Teste
    @endcomponent

    @component('mail::panel')
        Seja Bem Vindo ao nosso {{env('APP_NAME')}}.
    @endcomponent
</x-email::message>
