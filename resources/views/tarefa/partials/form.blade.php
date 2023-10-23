<div class="flex gap-2 w-full">
    <div class="group-input">
        <label for="nome" class="label">{{ __('Nome') }}</label>
        <div>
            <input id="nome" type="text" class="input" name="nome"
                value="{{ old('nome', $tarefa ?? '') }}" required>
        </div>
    </div>
    @error('nome')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <div class="group-input">
        <label for="data_prazo" class="label">Definir Prazo</label>
        <input type="datetime-local" name="data_prazo" id="data_prazo" value="{{ old('data_prazo', $tarefa ?? '') }}"
            class="input cursor-pointer" required>
    </div>
    @error('data_prazo')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="group-input">
    <label for="descricao" class="label">{{ __('Descricao') }}</label>
    <div>
        <input id="descricao" type="text" class="input" name="descricao" value="{{ old('descricao', $tarefa ?? '') }}" required>
    </div>
</div>
@error('descricao')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror


<div class="w-full flex gap-2 justify-end">
    <a href="{{ route('tarefa.index') }}"
        class="px-2 py-2 bg-purple-500 hover:bg-purple-800 rounded-lg flex items-center justify-center hover:shadow-xl duration-200 text-sm gap-2 text-white">
        Voltar
    </a>
    <button type="submit" class="btn-secondary">Enviar</button>
</div>
