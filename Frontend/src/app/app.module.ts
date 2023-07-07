import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpClientModule, HTTP_INTERCEPTORS } from '@angular/common/http';
import { Ng2SearchPipeModule } from 'ng2-search-filter';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { BrowserAnimationsModule } from '@angular/platform-browser/animations';
import { ToastrModule } from 'ngx-toastr';
import { CarouselModule } from 'ngx-owl-carousel-o';
import { NgxDaterangepickerMd } from 'ngx-daterangepicker-material';
import { GoogleMapsModule } from '@angular/google-maps';


import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NavbarComponent } from './component/layouts/navbar/navbar.component';
import { FooterComponent } from './component/layouts/footer/footer.component';
import { EditComponent } from './component/user/edit/edit.component';
import { HomeComponent } from './component/home/home.component';
import { RestaurantProfileComponent } from './component/restaurant-profile/restaurant-profile.component';
import { CartService } from './services/cart.service';
import { ProductService } from './services/product.service';
import { Product } from './entities/cart/product.entity';
import { SearchComponent } from './component/search/search.component';
import { SearchService } from './services/search.service';
import { RestaurantComponent } from './component/search/restaurant/restaurant.component';
import { RestaurantSearchService } from './services/search/restaurant-search.service';
import { ContactComponent } from './component/contact/contact.component';
import { LoginService } from './services/login.service';
import { AuthService } from './services/auth.service';
import { AuthGuard } from './guard/auth.guard';
import { TokenInterseptorService } from './guard/token-interseptor.service';
import { CheckoutComponent } from './component/checkout/checkout.component';
import { UserMenuComponent } from './component/layouts/user-menu/user-menu.component';
import { DashboardComponent } from './component/user/dashboard/dashboard.component';
import { AppUserComponent } from './component/user/app-user/app-user.component';
import { CommentComponent } from './component/user/comment/comment.component';
import { ListOrderComponent } from './component/user/list-order/list-order.component';
import { LogoutComponent } from './component/user/logout/logout.component';
import { UserDataService } from './services/user-data.service';
import { RegisterComponent } from './component/register/register.component';
import { RepasMapComponent } from './component/search/repas-map/repas-map.component';

@NgModule({
  declarations: [
    AppComponent,
    NavbarComponent,
    FooterComponent,
    EditComponent,
    HomeComponent,
    RestaurantProfileComponent,
    SearchComponent,
    RestaurantComponent,
    ContactComponent,
    CheckoutComponent,
    UserMenuComponent,
    DashboardComponent,
    AppUserComponent,
    CommentComponent,
    ListOrderComponent,
    LogoutComponent,
    RegisterComponent,
    RepasMapComponent,

  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    AppRoutingModule,
    Ng2SearchPipeModule,
    FormsModule  ,
    ReactiveFormsModule,
    BrowserAnimationsModule,
    GoogleMapsModule,
    ToastrModule.forRoot({
      progressBar: true,
      closeButton: true,
     progressAnimation: 'increasing',

    }),
    CarouselModule,
    NgxDaterangepickerMd.forRoot({
      separator: ' - ',
      applyLabel: 'Ok',
  })
  ],
  providers: [
    ProductService,
    Product,
    CartService,
    SearchService,
    RestaurantSearchService,
    LoginService,
    AuthService,
    AuthGuard,
    {
      provide: HTTP_INTERCEPTORS,
      useClass: TokenInterseptorService,
      multi: true
    },
    UserDataService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
