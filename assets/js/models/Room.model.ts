import RoomInterface from './Room.interface';

export default class Room implements RoomInterface
{
  id?: number | undefined;
  lib: string;
  desc?: string | undefined;
  capacity: number;

  constructor() {
    this.lib = '';
    this.capacity = 0;
  }
}