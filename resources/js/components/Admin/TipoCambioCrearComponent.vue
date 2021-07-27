<template>
  <div>
    <div class="row">
      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <form id="registerForm">
              <div class="row">
                <div class="col col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input
                      type="date"
                      class="form-control"
                      id="fecha"
                      name="fecha"
                      v-model="tipo_cambio.fecha"
                      v-validate="'required'"
                      :class="{'input':true,'danger': errors.has('fecha') }"
                      data-date-format="dd/mm/yyyy"
                    />

                    <i
                      v-show="errors.has('fecha')"
                      class="fa fa-warning"
                    ></i>
                    <span
                      v-show="errors.has('fecha')"
                      class="help text-danger"
                    >{{ errors.first('fecha') }}</span>
                  </div>
                </div>

                <div class="col col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="tc_compra">Tc. Compra</label>
                    <input
                      type="number"
                      class="form-control"
                      id="tc_compra"
                      name="tc_compra"
                      v-model="tipo_cambio.tc_compra"
                      required
                      step="0.001"
                      min="0"
                      v-validate="'decimal:3'"
                      :class="{'input':true,'danger': errors.has('tc_compra') }"
                    />

                    <i
                      v-show="errors.has('tc_compra')"
                      class="fa fa-warning"
                    ></i>
                    <span
                      v-show="errors.has('tc_compra')"
                      class="help text-danger"
                    >{{ errors.first('tc_compra') }}</span>
                  </div>
                </div>
                <div class="col col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="tc_venta">Tc. Venta</label>
                    <input
                      type="number"
                      class="form-control"
                      id="tc_venta"
                      name="tc_venta"
                      v-model="tipo_cambio.tc_venta"
                      required
                      step="0.001"
                      min="0"
                      v-validate="'decimal:3'"
                      :class="{'input':true,'danger': errors.has('tc_venta') }"
                    />
                    <i
                      v-show="errors.has('tc_venta')"
                      class="fa fa-warning"
                    ></i>
                    <span
                      v-show="errors.has('tc_venta')"
                      class="help text-danger"
                    >{{ errors.first('tc_venta') }}</span>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="cols-12">
                  <button
                    type="button"
                    class="btn btn-secondary"
                    data-dismiss="modal"
                  >
                    Cerrar
                  </button>
                  <button
                    type="button"
                    @click="validateBeforeSubmit()"
                    class="btn btn-primary"
                  >
                    Guardar
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tipo_cambio: {
        fecha: "",
        tc_compra: "",
        tc_venta: "",
        fecha: ""
      },
      tipo_cambio_inicial: {
        fecha: "",
        tc_compra: "",
        tc_venta: "",
        fecha: ""
      }
    };
  },

  methods: {
    saveTipoCambios() {
      axios.post(`../api/v1/tipo-cambio`, this.tipo_cambio).then(res => {
        if (res.data.status == 1) {
          this.$swal.fire({
            icon: "success",
            title: "Felicidades...",
            text: res.data.mensaje
          });
          this.tipo_cambio = this.tipo_cambio_inicial;
        } else if (res.data.status == 0) {
          this.$swal.fire({
            icon: "error",
            title: "Oops...",
            text: res.data.mensaje
          });
        }
      });
    },
    validateBeforeSubmit: function() {
      this.$validator.validateAll().then(result => {
        if (result) {
          this.saveTipoCambios();
        }
        //errores
      });
    }
  }
};
</script>
