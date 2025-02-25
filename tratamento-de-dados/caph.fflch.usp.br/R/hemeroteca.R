setwd("~/remota/repos/fflch/caph-fflch-usp-br/scripts/")

# - catálogo49  - sistema no Microsoft em Acess - Verdinho
catalogo49 <- read.csv('data/TabelaCatalogo49.csv')
unique(catalogo49$suporte)

# - GeralBDtese - sistema no Microsoft em Acess - Amarelinho 
amarelinho <- read.csv('data/TabelaGeralBdtese.csv')
unique(amarelinho$suporte)

hemeroteca = subset(catalogo49,suporte=='Hemeroteca')                      

## Explorando amarelinho ##

# Quantidade total de entrada no suporte:
nrow(subset(amarelinho,suporte %in% 'Hemeroteca'))

# A quantidade de microfichas nos dois banco de dados são a mesma.
# aparentemente são os mesmo registros.

# Preparar dados para importação no Drupal
colunas = c('especificação', 
            'nreferencia', 
            'numero',
            'local',
            'data',
            'titulo',
            'quantidade',
            'País')
microfichas = microfichas[,colunas]
write.csv(microfichas,file='outputs/microfichas.csv')
unique(microfichas$Sistema)
