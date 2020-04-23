<template>
<v-card>
  <v-toolbar>
    <v-toolbar-title v-if="room.id === 0">{{ $t('room.form.titleCreate') }}</v-toolbar-title>
    <v-toolbar-title v-else>{{ $t('room.form.titleUpdate', {lib: room.lib}) }}</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-btn text color="warning" :to="room.id === 0 ? {name: 'Rooms'} : {name: 'Room', params: {id: room.id, action: 'show'}}">
      {{ $t('room.form.btn.cancel') }}
    </v-btn>
    <v-btn text color="success" @click="update">
      {{ $t(room.id === 0 ? 'room.form.btn.add' : 'room.form.btn.update') }}
    </v-btn>
  </v-toolbar>
  <v-card-text>
    <ValidationObserver ref="validator">
      <form>
        <v-container>
          <ValidationProvider v-slot="{ errors }" name="lib" :rules="{requiredLib: true , maxLib: {length: 50}}">
            <v-text-field
              v-model="room.lib"
              :label="$t('room.form.lib')"
              required
              :error-messages="errors"
            ></v-text-field>
          </ValidationProvider>
          <ValidationProvider v-slot="{ errors }" name="desc" :rules="{maxDesc: {length: 255}}">
            <v-textarea
              v-model="room.desc"
              :label="$t('room.form.desc')"
              :error-messages="errors"
            ></v-textarea>
          </ValidationProvider>
          <ValidationProvider v-slot="{ errors }" name="capacity" :rules="{minCapacity: {min: 0}}">
            <v-slider
              :label="$t('room.form.capacity')"
              v-model="room.capacity"
              class="align-center"
              :min="0"
              :max="room.capacity > 40 ? room.capacity : 40"
              :error-messages="errors"
            >
              <template v-slot:append>
                  <v-text-field
                    v-model="room.capacity"
                    class="mt-0 pt-0"
                    single-line
                    type="number"
                    style="width: 60px"
                    :error-messages="errors"
                  ></v-text-field>
              </template>
          </v-slider>
          </ValidationProvider>
        </v-container>
      </form>
    </ValidationObserver>
  </v-card-text>
</v-card>
</template>

<script lang="ts">
import { Vue, Component, Prop} from 'vue-property-decorator'
import RoomInterface from '../../models/Room.interface'
import { ValidationObserver, ValidationProvider, setInteractionMode, extend } from 'vee-validate';
import { required, min_value, max } from 'vee-validate/dist/rules';


@Component({
  name: 'RoomEdit',
  components: {
    ValidationObserver,
    ValidationProvider
  }
})
export default class RoomEdit extends Vue {
  @Prop()
  room!: RoomInterface;

  $refs!: {
    validator: InstanceType<typeof ValidationObserver>;
  };

  mounted() {
    setInteractionMode('eager');

    extend('requiredLib', {
      ...required,
      message: this.$t('room.form.validator.lib.required').toString()
    });
    extend('maxLib', {
      ...max,
      message: (_, data) => this.$t('room.form.validator.lib.max', {length: data ? data.length : 0}).toString()
    });
    extend('maxDesc', {
      ...max,
      message: (_, data) => this.$t('room.form.validator.desc.max', {length: data ? data.length : 0}).toString()
    });
    extend('minCapacity', {
      ...min_value,
      message: (_, data) => this.$t('room.form.validator.capacity.min', {min: data ? data.min : 0}).toString()
    });
  }

  update() {
    this.$refs.validator.validate()
    .then(valid => {
      if(valid){
        this.$emit('update', this.room);
        this.$refs.validator.reset();
      }
    })
    .catch(console.error);
  }
}
</script>
