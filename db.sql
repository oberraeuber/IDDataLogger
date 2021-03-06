CREATE TABLE carStatus (
  time                      TIMESTAMP NOT NULL PRIMARY KEY,
  batterySOC                decimal(3, 0),
  remainingRange            smallint,
  remainingChargingTime     smallint,
  chargeState               text,
  chargePower               decimal(4, 1),
  chargeRateKMPH            smallint,
  maxChargeCurrentAC        text,
  autoUnlockPlugWhenCharged text,
  targetSOC                 decimal(3, 0),
  plugConnectionState       text,
  plugLockState             text,
  remainClimatisationTime   smallint,
  hvacState                 text,
  hvacTargetTemp            decimal(3, 1),
  hvacWithoutExternalPower  boolean,
  hvacAtUnlock              boolean,
  windowHeatingEnabled      boolean,
  zoneFrontLeftEnabled      boolean,
  zoneFrontRightEnabled     boolean,
  zoneRearLeftEnabled       boolean,
  zoneRearRightEnabled      boolean,
  frontWindowHeatingState   text,
  rearWindowHeatingState    text
);

CREATE TABLE users (
    userid serial NOT NULL PRIMARY KEY,
    username text UNIQUE NOT NULL,
    hash text NOT NULL
);

CREATE TABLE authKeys (
    key text NOT NULL
);

CREATE TABLE carPictures (
    id text NOT NULL PRIMARY KEY,
    carPicture text NOT NULL
);