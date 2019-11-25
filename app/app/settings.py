# DEV or PRO
ENV_TYPE = 'DEV'

if ENV_TYPE == 'DEV':
    from .dev_settings import *
else:
    from .pro_settings import *
