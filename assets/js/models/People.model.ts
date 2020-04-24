import PeopleInterface from './People.interface';

export default class People implements PeopleInterface
{
  id: number;
  lastname: string;
  firtname: string;

  constructor() {
    this.id = 0;
    this.lastname = '';
    this.firtname = '';
  }
}