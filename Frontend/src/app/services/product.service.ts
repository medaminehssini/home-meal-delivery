import { Injectable } from '@angular/core';
import { Product } from '../entities/cart/product.entity';
import { HttpClient } from '@angular/common/http';
import { Global } from '../entities/global.entity';

@Injectable()
export class ProductService {

  global = new Global();
  constructor(
    private http: HttpClient
  ) {
  }

   find(id: string, type: string) {
    let repas;
    const apiURL = this.global.apiURL + 'api/' + type + '/' + id;
    return this.http.get(apiURL);
  }
}
