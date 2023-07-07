import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { AuthService } from '../services/auth.service';
import { ToastrService } from 'ngx-toastr';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {
  constructor(private auth: AuthService,
              private route: Router,
              private toast: ToastrService

    ) {

  }
  canActivate( ): boolean {
    if (this.auth.logedIn()) {
      return true;
    } else {
      this.toast.error('veuillez s\'inscrire pour passer une commande');
      this.route.navigate(['/home']);
      return false;
    }

  }
}
