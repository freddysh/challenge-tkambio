<template>
  <div>
    <vue-good-table
      :columns="columns"
      :rows="tipo_cambios"
      :line-numbers="true"
      :pagination-options="{
                enabled: true,
                mode: 'records',
                perPage: 10,
                position: 'botton',
                perPageDropdown: [10, 15, 20, 25, 50],
                dropdownAllowAll: true,
                setCurrentPage: 1,
                nextLabel: 'Siguiente',
                prevLabel: 'Previo',
                rowsPerPageLabel: 'Filas por pagina',
                ofLabel: 'de',
                pageLabel: 'pagina', // for 'pages' mode
                allLabel: 'Todos',
                infoFn: (params) => `${params.totalRecords} registros`,
            }"
      :search-options="{
                enabled: true
            }"
    >
      <template
        slot="table-row"
        slot-scope="props"
      >

        <span v-if="props.column.field == 'fecha'">
          {{moment(props.row.fecha).format('DD/MM/YYYY') }}
        </span><span v-if="props.column.field == 'tc_venta'">
          {{props.row.tc_venta}}
        </span><span v-if="props.column.field == 'tc_compra'">
          {{props.row.tc_compra}}
        </span>
        <span v-if="props.column.field == 'created_at'">
          {{moment(props.row.created_at).format('D MMMM YYYY, h:mm:ss a') }}
        </span>
        <div
          class="btn-group"
          role="group"
          v-if="props.column.field == 'opciones'"
        >

          <button
            class="btn btn-warning"
            @click="editar(props.row)"
          >
            <i class="fas fa-edit"></i>
          </button>
          <button
            class="btn btn-danger"
            @click="borrar(props.row.id)"
          >
            <i class="fas fa-trash-alt"></i>
          </button>
        </div>
      </template>
    </vue-good-table>
    <!-- Modal -->
    <div
      class="modal fade"
      id="mymodal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div
        class="modal-dialog modal-sm"
        role="document"
      >
        <div class="modal-content">
          <div class="modal-header">
            <h5
              class="modal-title"
              id="exampleModalLabel"
            >
              Editar tipo de cambio
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
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
            </form>
          </div>
          <div class="modal-footer">
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
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      tipo_cambios: [],
      columns: [
        {
          field: "fecha",
          label: "Fecha"
        },
        {
          field: "tc_compra",
          label: "Tc Compra"
        },
        {
          field: "tc_venta",
          label: "Tc Venta"
        },
        {
          field: "created_at",
          label: "Creado"
        },
        {
          field: "opciones",
          label: "Opciones"
        }
      ],
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
  created() {
    this.getTipoCambios();
  },

  methods: {
    getTipoCambios() {
      axios.get(`../api/v1/tipo-cambio`).then(res => {
        this.tipo_cambios = res.data.map(obj => ({
          id: obj.id,
          fecha: obj.fecha,
          tc_compra: obj.tc_compra,
          tc_venta: obj.tc_venta,
          created_at: obj.created_at,
          opciones: obj.id
        }));
        this.tipo_cambios.sort(function(a, b) {
          if (a.created_at > b.created_at) {
            return 1;
          }
          if (a.created_at < b.created_at) {
            return -1;
          }
          // a must be equal to b
          return 0;
        });
      });
    },
    async editTipoCambios() {
      await axios
        .put(`../api/v1/tipo-cambio/${this.tipo_cambio.id}`, this.tipo_cambio)
        .then(res => {
          if (res.data.status == 1) {
            this.$swal.fire({
              icon: "success",
              title: "Felicidades...",
              text: res.data.mensaje
            });
          } else if (res.data.status == 0) {
            this.$swal.fire({
              icon: "error",
              title: "Oops...",
              text: res.data.mensaje
            });
          }
        });
    },
    softDeleteTipoCambios(id) {
      console.log("id", id);
      axios.delete(`../api/v1/tipo-cambio/${id}`).then(res => {
        console.log("res", res.data);
        if (res.data.status == 1) {
          this.$swal.fire({
            icon: "success",
            title: "Felicidades...",
            text: res.data.mensaje
          });
          this.getTipoCambios();
        } else if (res.data.status == 0) {
          this.$swal.fire({
            icon: "error",
            title: "Oops...",
            text: res.data.mensaje
          });
        }
      });
    },
    borrar(id) {
      this.$swal
        .fire({
          title: "Estas seguro?",
          text: "No podras revertir esta operación!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, borrar!",
          cancelButtonText: "Cancelar"
        })
        .then(result => {
          if (result.isConfirmed) {
            this.softDeleteTipoCambios(id);
          }
        });
    },
    toggleModal() {
      $("#mymodal").modal("toggle");
    },
    editar(tipo_cambio_) {
      this.tipo_cambio = this.tipo_cambio_inicial;
      this.tipo_cambio = tipo_cambio_;
      this.toggleModal();
    },
    validateBeforeSubmit: function() {
      this.$validator.validateAll().then(result => {
        if (result) {
          this.editTipoCambios();
          this.toggleModal();
        }
      });
    }
  }
};
</script>
