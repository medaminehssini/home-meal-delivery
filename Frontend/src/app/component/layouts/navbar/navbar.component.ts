import { Component, OnInit } from '@angular/core';
import { CartService } from 'src/app/services/cart.service';
import { Global } from 'src/app/entities/global.entity';
import { AuthService } from 'src/app/services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {
  isOpenCart = false;
  global = new Global();
  constructor(
    public cart: CartService,
    public auth: AuthService,
    private router: Router
    ) { }

  ngOnInit() {
    this.cart.loadCart();
  }

  logout() {
    this.auth.logout();
    this.router.navigate(['/home']);
  }

  verifLogo(urlLogo, nom) {
    if (urlLogo === '') {
      return this.global.logoURL + nom;
    } else {
      return this.global.apiURL + urlLogo;
    }
  }

  goTo(url) {
    this.isOpenCart = false;
    this.router.navigate([ url ]);
  }
}
