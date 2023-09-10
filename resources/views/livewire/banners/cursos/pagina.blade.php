<div class="row">
    <div class="col-12">
        @foreach ($banners as $banner)
            <div class="card mb-4 container-banner" style="position: relative;">
                <div class="w-100 d-flex justify-content-center align-items-center" style="max-height: 300px;">
                    <img @if (!$banner->ativo) style="filter: grayscale(100);" @endif
                        src="{{ $banner->caminho }}" class="w-100" alt="">
                </div>
                <div class="banner-options-container">
                    <div class="banner-options" style="">
                        <i class="fas fa-arrow-circle-up fa-lg @if ($banner->posicao == 1) color-disabled @else icone-banner text-success cpointer @endif"
                            @if ($banner->posicao > 1) wire:click="sobePosicao({{ $banner->id }})" @endif></i>
                        <i class="fas fa-arrow-circle-down fa-lg ms-3 @if ($banner->posicao == $max) color-disabled @else icone-banner text-success cpointer @endif"
                            @if ($banner->posicao < $max)  @endif
                            wire:click="descePosicao({{ $banner->id }})"></i>
                        <i class="icone-banner fas fa-times-circle fa-lg ms-3 text-danger cpointer"
                            wire:click="excluir({{ $banner->id }})"></i>
                        @if ($banner->ativo)
                            <i class="icone-banner cpointer fas fa-eye-slash fa-lg ms-3"
                                wire:click="desativar({{ $banner->id }})"></i>
                        @else
                            <i class="icone-banner cpointer fas fa-eye fa-lg ms-3"
                                wire:click="ativar({{ $banner->id }})"></i>
                        @endif
                        <div class="input-link-container ms-3">
                            <div class="input-group">
                                <div class="input-group-text"><i class="fas fa-link fa-lg"></i></div>
                                <input type="text" class="form-control" placeholder="Link"
                                    value="{{ $banner->link }}"
                                    onchange="Livewire.emit('atualizaLink', {{ $banner->id }}, this.value)">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="card">
            <div class="w-100 d-flex justify-content-center align-items-center" style="height: 100px;">
                <label for="input_banner"><i class="fas fa-plus-circle cpointer" style="font-size: 60px"></i></label>
                <input type="file" name="" id="input_banner" class="d-none" wire:model='arquivo'
                    accept="image/*">
            </div>
        </div>
    </div>
    <x-loading></x-loading>
</div>

@push('styles')
    <style>
        .icone-banner {
            transition: 0.3 all;
        }

        .icone-banner:hover {
            transform: scale(1.05);
        }

        .color-disabled {
            color: gray;
        }

        .input-link-container {
            width: 450px;
        }

        .banner-options-container {
            width: 100%;
            position: absolute;
            bottom: 0;
            display: flex;
            justify-content: center;
        }

        .banner-options {
            visibility: hidden;
            background-color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            min-width: 300px;
            padding: 10px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            /* left: calc(50% - 150px); */
            /* transition: 0.3s all; */
            padding: 10px 30px;
        }

        .banner-options:hover {
            visibility: visible;
        }

        .container-banner:hover .banner-options {
            visibility: visible;
        }
    </style>
@endpush
