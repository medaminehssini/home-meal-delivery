import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Global } from 'src/app/entities/global.entity';

@Injectable({
  providedIn: 'root'
})
export class RestaurantSearchService {
  global = new Global();
  constructor(
    private http: HttpClient,
  ) { }


  getRestaurants(page, nom , specialite) {
   return this.http.get(this.global.apiURL + '/api/list/restaurant' + page + '&nom=' + nom + '&specialite=' + specialite );
  }
}
