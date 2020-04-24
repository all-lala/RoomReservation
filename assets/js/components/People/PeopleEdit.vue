<template>
<v-card>
  <v-toolbar>
    <v-toolbar-title v-if="people.id === 0">{{ $t('people.form.titleCreate') }}</v-toolbar-title>
    <v-toolbar-title v-else>{{ $t('people.form.titleUpdate', {lastname: people.lastname}) }}</v-toolbar-title>
    <v-spacer></v-spacer>
    <v-btn text color="warning" :to="people.id === 0 ? {name: 'Peoples'} : {name: 'People', params: {id: people.id, action: 'show'}}">
      {{ $t('people.form.btn.cancel') }}
    </v-btn>
    <v-btn text color="success" @click="update">
      {{ $t(people.id === 0 ? 'people.form.btn.add' : 'people.form.btn.update') }}
    </v-btn>
  </v-toolbar>
  <v-card-text>
    <ValidationObserver ref="validator">
      <form>
        <v-container>
          <ValidationProvider v-slot="{ errors }" name="lastname" :rules="{requiredLastname: true, maxLastname: {length: 255}}">
            <v-text-field
              v-model="people.lastname"
              :label="$t('people.form.lastname')"
              required
              :error-messages="errors"
            ></v-text-field>
          </ValidationProvider>
          <ValidationProvider v-slot="{ errors }" name="firstname" :rules="{requiredFirstname: true, maxFirstname: {length: 255}}">
            <v-text-field
              v-model="people.firstname"
              :label="$t('people.form.firstname')"
              required
              :error-messages="errors"
            ></v-text-field>
          </ValidationProvider>
        </v-container>
      </form>
    </ValidationObserver>
  </v-card-text>
</v-card>
</template>

<script lang="ts">
import { Vue, Component, Prop} from 'vue-property-decorator'
import PeopleInterface from '../../models/People.interface'
import { ValidationObserver, ValidationProvider, setInteractionMode, extend } from 'vee-validate';
import { required, min_value, max } from 'vee-validate/dist/rules';


@Component({
  name: 'PeopleEdit',
  components: {
    ValidationObserver,
    ValidationProvider
  }
})
export default class PeopleEdit extends Vue {
  @Prop()
  people!: PeopleInterface;

  $refs!: {
    validator: InstanceType<typeof ValidationObserver>;
  };

  mounted() {
    setInteractionMode('eager');

    extend('requiredLastname', {
      ...required,
      message: this.$t('people.form.validator.lastname.required').toString()
    });
    extend('maxLastname', {
      ...max,
      message: (_, data) => this.$t('people.form.validator.lastname.max', {length: data ? data.length : 0}).toString()
    });
    extend('requiredFirstname', {
      ...required,
      message: this.$t('people.form.validator.firstname.required').toString()
    });
    extend('maxFirstname', {
      ...max,
      message: (_, data) => this.$t('people.form.validator.firstname.max', {length: data ? data.length : 0}).toString()
    });
  }

  update() {
    this.$refs.validator.validate()
    .then(valid => {
      if(valid){
        this.$emit('update', this.people);
        this.$refs.validator.reset();
      }
    })
    .catch(console.error);
  }
}
</script>
