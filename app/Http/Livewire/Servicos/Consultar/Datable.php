<?php

namespace App\Http\Livewire\Servicos\Consultar;

use Livewire\Component;
use App\Models\Servicos;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Classes\Util;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Datable extends Component
{
	use WithPagination;
	use WithFileUploads;

    public $icons = [];
    public $banners = [];


	protected $paginationTheme = "bootstrap";
	protected $listeners = ["atualizaDatatableServicos" => '$refresh', 'atualizaValorAssociado'];


    public function updatedIcons($value, $key){
        $servico = Servicos::find($key);
        if($this->icons[$key]){
            Storage::delete($servico->icon);
            $servico->icone = asset($this->icons[$key]->store('images/servicos/', 'local'));
            Util::limparLivewireTemp();
        }
        $servico->save();
        $this->icons = [];
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Imagem atualizada com sucesso!']);
    }

    public function updatedBanners($value, $key){
        $servico = Servicos::find($key);
        if($this->banners[$key]){
            Storage::delete($servico->banner);
            $servico->banner = asset($this->banners[$key]->store('images/servicos/', 'local'));
            Util::limparLivewireTemp();
        }
        $servico->save();
        $this->banners = [];
        $this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Imagem atualizada com sucesso!']);
    }

	public function excluir(Servicos $servicos)
	{
		$servicos->delete();
		$this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Serviço removido com sucesso!']);
		$this->emit('$refresh');
	}


	public function ativar(Servicos $servicos)
	{

		$servicos->ativo = !$servicos->ativo;
		$servicos->save();
		$this->dispatchBrowserEvent('notificaToastr', ['tipo' => 'success', 'mensagem' => 'Serviço alterado com sucesso!']);
		$this->emit('$refresh');
	}

	public function render()
	{
		$servicos = Servicos::orderBy("created_at", "DESC")->paginate(20);
		return view('livewire.servicos.consultar.datable', ["servicos" => $servicos]);
	}
}
