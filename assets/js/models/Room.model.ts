import RoomInterface from './Room.interface';

export default class Room implements RoomInterface
{
  id: number;
  lib: string;
  desc?: string | undefined;
  capacity: number;

  constructor() {
    this.id = 0;
    this.lib = '';
    this.capacity = 0;
  }
}