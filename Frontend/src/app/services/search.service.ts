import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Global } from '../entities/global.entity';

@Injectable({
  providedIn: 'root'
})
export class SearchService {
  global = new Global();
  constructor(
    private http: HttpClient,
  ) { }

  getRepas(type , page, prix , libelle, specialite , orderBy , withget) {
    // tslint:disable-next-line:max-line-length
    return this.http.get(this.global.apiURL + 'api/list/' + type + page + '&prix=' + prix + '&libelle=' + libelle + '&specialite=' + specialite + '&orderBy=' + orderBy + '&withget=' + withget);
  }

  getSpecialite(libelle) {
    // tslint:disable-next-line:max-line-length
    return this.http.get(this.global.apiURL + 'api/list/specialite' + '?libelle=' + libelle);
  }

  getTags() {
    // tslint:disable-next-line:max-line-length
    return this.http.get(this.global.apiURL + 'api/list/tags');
  }
}
