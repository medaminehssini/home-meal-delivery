import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Global } from '../entities/global.entity';

@Injectable({
  providedIn: 'root'
})
export class HomeService {
     global = new Global();
  constructor(
    private http: HttpClient
  ) { }

  getRestaurant() {
    return this.http.get(this.global.apiURL + 'api/list/repas');
  }
}
