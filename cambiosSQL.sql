UPDATE poliza_inclusion pi
SET pi.pct_fraccionamiento = (SELECT pct_fraccionamiento FROM poliza p WHERE p.id = pi.poliza_id);

UPDATE poliza_inclusion pi
SET pi.cantidad_pagos = (SELECT cantidad_pagos FROM poliza p WHERE p.id = pi.poliza_id);