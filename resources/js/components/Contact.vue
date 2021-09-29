// css
<style>
  .show {
    display: list-item;
    opacity: 1;
    background: rgba(44, 38, 75, 0.849);
  }
</style>

// contiene el html
<template>
  <div>
    <h1 class="text-center">Agenda de contactos</h1>
    <hr />

    <!-- Button trigger modal -->
    <button @click="update = false; openModal();" type="button" class="btn btn-primary" >Nuevo Contacto</button>

    <!-- Modal -->
    <div class="modal" :class="{show:modal}">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">{{titleModal}}</h5>
            <button @click="closeModal();" type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button @click="closeModal();" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success">Guardar Cambios</button>
          </div>
        </div>
      </div>
    </div>


    <table class="table table-striped table-hover">
      <thead class="thead-dark">
        <tr>
            <th scope="col">id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Correo electronico</th>
            <th scope="col">Telefono</th>
            <th scope="col">Domicilio</th>
            <th scope="col" colspan="2" class="text-center">Accion</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="contact in contacts" :key="contact.id">
            <th scope="row">{{ contact.id }}</th>
            <td>{{ contact.first_name }}</td>
            <td>{{ contact.last_name }}</td>
            <td>{{ contact.email }}</td>
            <td>{{ contact.phone }}</td>
            <td>{{ contact.address }}</td>
            <td><button @click="update = true; openModal(contact.id);" class="btn btn-warning">Editar</button></td>
            <td><button @click="eliminar(contact.id)" class="btn btn-danger">Eliminar</button></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

// javascript
<script>
    export default {
        data() {
            return {
              update: true,
              modal: 0,
              titleModal: ' ',
              contacts: [],
            }
        },
        methods: {
            async list() {
                const res = await axios.get('contacts');
                this.contacts = res.data;
            },
            async eliminar(id) {
                const res = await axios.delete('/contacts/' + id);
                this.list();
            },
            openModal(id = 0) {
              this.modal = 1;
              if (this.update) {
                this.titleModal = 'Modificar Contacto';
              } else {
                this.titleModal = 'Crear Contacto';
              }
            },
            closeModal() {
              this.modal = 0;
            },
        },
        created() {
            this.list();
        },
    };
</script>


