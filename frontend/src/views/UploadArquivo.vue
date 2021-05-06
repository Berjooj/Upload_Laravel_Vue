<template>
  <div class="mt-5">
    <b-card class="shadow w-50 mr-auto ml-auto text-center"
            title="Envie um arquivo..."
    >
      <!--      <b-card-text class="text-secondary">Clique ou arraste aqui.</b-card-text>-->
      <!--Caso precise validar o tipo de arquivo usa: accept="image/*"-->
      <b-form-file
          class="upload-arquivo"
          v-model="arquivo"
          browse-text="Escolher"
          required
          :state="Boolean(arquivo)"
          placeholder="Escolha um arquivo ou arraste aqui..."
          drop-placeholder="Arraste um arquivo..."
          @input="atualizaTamanhoArquivo()"
      ></b-form-file>

      <b-alert
               class="alerta"
               variant="success"
               :show="dismissCountDown"
               dismissible
               @dismissed="dismissCountDown=0"
               @dismiss-count-down="showAlert"
      >
        {{ resposta }}... {{ dismissCountDown }}
      </b-alert>

      <b-alert show
               class="alerta"
               variant="danger"
               v-show="mostrar_alerta_erro"
      >
        {{ resposta }}
      </b-alert>


      <div class="mt-3">Tamanho do arquivo: {{ arquivo_tamanho }} MB.</div>

      <b-button href="#" variant="primary" :disabled="bloqueiaEnvio" @click="enviarArquivo()">
        <b-spinner type="grow" label="Spinning" v-if="loading"></b-spinner>
        <span v-if="!loading">Enviar</span>
      </b-button>
    </b-card>
  </div>
</template>

<script>
import arquivo from "@/services/arquivo";

export default {
  data() {
    return {
      mostrar_alerta_erro: false,
      mostrar_alerta_sucesso: false,
      resposta: "e",
      arquivo: null,
      arquivo_tamanho: 0.0,
      bloqueiaEnvio: true,
      loading: false,
      dismissCountDown: 0
    }
  },
  methods: {
    atualizaTamanhoArquivo() {
      this.arquivo_tamanho = (this.arquivo.size / 1024 / 1024).toFixed(2);

      this.bloqueiaEnvio = this.arquivo_tamanho >= 5;
      this.mostrar_alerta_erro = this.arquivo_tamanho >= 5;
      this.resposta = "Arquivo não pode ter mais que 5mb!";

    },
    enviarArquivo() {
      this.loading = true;

      if (!this.arquivo) {
        this.bloqueiaEnvio = true;
        this.resposta = "Por favor, selecione um arquivo válido";
        this.mostrar_alerta_erro = true;
      } else {
        let formData = new FormData();

        formData.append('arquivo', this.arquivo);

        return arquivo.post('/upload', formData, {
          headers: {
            "Content-Type": "multipart/form-data"
          }
        }).then((response) => {
          this.loading = false;
          this.resposta = response["data"]["mensagem"];
          this.arquivo = null;
          this.arquivo_tamanho = 0;

          this.mostrar_alerta_sucesso = true;
          this.showAlert(5);
        }).catch(() => {
          this.loading = false;
        })
      }
    },
    showAlert(dismissCountDown) {
      this.dismissCountDown = dismissCountDown;
    }
  }
}
</script>

<style scoped>
.load-visible {
  visibility: visible !important;
}

.load-hidden {
  visibility: hidden !important;
}

.upload-arquivo {
  /*height: 300px!important;*/
}

.alerta {
  margin-top: 2rem;
  text-align: center;
}

</style>