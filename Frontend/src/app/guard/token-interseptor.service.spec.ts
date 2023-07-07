import { TestBed } from '@angular/core/testing';

import { TokenInterseptorService } from './token-interseptor.service';

describe('TokenInterseptorService', () => {
  let service: TokenInterseptorService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(TokenInterseptorService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
