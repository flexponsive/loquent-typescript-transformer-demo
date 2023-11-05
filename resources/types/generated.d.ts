declare namespace App.Enums {
    export type UserRole = "admin" | "guest" | "professional";
}
declare namespace App.Models {
    export type BusinessFunction = {
        id: number;
        name: string;
        description?: string;
        created_at?: string;
        updated_at?: string;
        orgUnits?: Array<
            App.Models.OrgUnit & {
                contribution?: App.Models.BusinessFunctionOrgUnit;
            }
        >;
    };
    export type BusinessFunctionOrgUnit = {
        id: number;
        business_function_id: number;
        org_unit_id: number;
        created_at?: string;
        updated_at?: string;
    };
    export type OrgUnit = {
        id: number;
        name: string;
        address?: string;
        created_at?: string;
        updated_at?: string;
        users?: Array<App.Models.User>;
        businessFunctions?: Array<
            App.Models.BusinessFunction & {
                pivot?: App.Models.BusinessFunctionOrgUnit;
            }
        >;
    };
    export type User = {
        id: number;
        name: string;
        email: string;
        email_verified_at?: string;
        created_at?: string;
        updated_at?: string;
        role?: App.Enums.UserRole;
        bigint_without_cast?: number;
        names_of_siblings?: Array<any>;
        secret_question?: string;
        is_active: boolean;
        cohort_month?: string;
        signup_fee?: string;
        rand_double?: number;
        secret_answer?: string;
        rand_float?: number;
        options?: object;
        login_count?: number;
        last_login_ts?: number;
        org_unit_id?: number;
        reverse_email: any;
        orgUnit?: App.Models.OrgUnit;
        tokens?: Array<any>;
        notifications?: Array<any>;
    };
}
